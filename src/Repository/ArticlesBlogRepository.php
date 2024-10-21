<?php

namespace App\Repository;

use App\Entity\ArticlesBlog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;

/**
 * @extends ServiceEntityRepository<ArticlesBlog>
 *
 * @method ArticlesBlog|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArticlesBlog|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArticlesBlog[]    findAll()
 * @method ArticlesBlog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticlesBlogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArticlesBlog::class);
    }

    /**
     * Retourne le dernier article
     */
    public function findLastArticle(): ?ArticlesBlog
    {
        // Création d'un objet QueryBuilder pour construire la requête.
        // 'a' est un alias pour l'entité ArticlesBlog dans cette requête.
        return $this->createQueryBuilder('a')
            // Ajout d'un critère de tri : trier les articles par 'dateCreation'
            // en ordre décroissant ('DESC'), ce qui signifie du plus récent au plus ancien.
            ->orderBy('a.date_creation', 'DESC')

            // Ajout d'un critère de publication
            ->where('a.publication = :isPublished')
            ->setParameter('isPublished', true)

            // Limite le nombre de résultats à 1.
            // Puisque les résultats sont triés par date de façon décroissante,
            // cela retournera le dernier (le plus récent) article.
            ->setMaxResults(1)

            // Convertit le QueryBuilder en une Query exécutable.
            ->getQuery()

            // Exécute la requête et obtient un seul résultat.
            // Si aucun article n'est trouvé, cela retournera 'null'.
            ->getOneOrNullResult();
    }

     /**
     * @param int $index
     * @return Article[]
     */
    public function findArticlesFromIndex(int $index): array
    {
        // Vérifie que l'index est valide
        if ($index < 0) {
            throw new \InvalidArgumentException('L\'index doit être supérieur ou égal à zéro.');
        }

        // Utilise une requête pour récupérer 4 articles à partir de l'index donné
        $articles = $this->createQueryBuilder('a')
            ->setFirstResult($index)
            ->setMaxResults(4)
            ->orderBy('a.date_creation', 'DESC')
            ->getQuery()
            ->getResult();

        if (empty($articles)){
            return ['message' => 'Il n\'y a plus d\'autres articles à générer.'];
        }

        return $articles;
    }

    /**
     * Retourne tableau de tous les articles 
     */
    public function findAllArticles(): array
    {

        $qb = $this->createQueryBuilder('a')
            ->where('a.publication = :isPublished')
            ->setParameter('isPublished', true);

        // Ajout d'un tri par date de création, dans l'ordre décroissant
        $qb->orderBy('a.date_creation', 'DESC');

        $query = $qb->getQuery();

        return $query->getResult();
    }

    /**
     * Retourne une Query de tous les articles sauf le dernier pour la pagination
     */
    public function findAllExceptLastQuery(): Query
    {
        $lastArticle = $this->findLastArticle();

        $qb = $this->createQueryBuilder('a')
            ->where('a.publication = :isPublished')
            ->setParameter('isPublished', true);

        if ($lastArticle) {
            $qb->andWhere('a.id != :lastArticleId')
            ->setParameter('lastArticleId', $lastArticle->getId());
        }

        // Ajout d'un tri par date de création, dans l'ordre décroissant
        $qb->orderBy('a.date_creation', 'DESC');

        return $qb->getQuery();
    }

    public function findAllCategories(): array
    {
        // Créer un objet QueryBuilder pour construire la requête.
        // 'a' est un alias pour l'entité ArticlesBlog dans cette requête.
        // 'c' sera un alias pour la jointure avec l'entité Catégorie.
        $qb = $this->createQueryBuilder('a')
            ->select('DISTINCT c.nom, c.slug') // Sélectionne les noms et slugs de catégories distincts
            ->innerJoin('a.categorie', 'c') // Effectue une jointure avec l'entité Catégorie
            ->where('a.publication = :isPublished')
            ->setParameter('isPublished', true)
            ->orderBy('c.nom', 'ASC'); // Trie les catégories par nom dans l'ordre ascendant

        // Convertit le QueryBuilder en une Query exécutable.
        $query = $qb->getQuery();

        // Exécute la requête et obtient les résultats.
        // getResult() retourne un tableau des résultats de la requête.
        return $query->getResult();
    }

    public function getArticlesByCategoryQuery(string $categoryName): Query
    {
        // Sous-requête pour obtenir la date de création du dernier article publié dans la catégorie
        $subQueryBuilder = $this->createQueryBuilder('sub')
            ->select('MAX(sub.date_creation) as lastArticleDate')
            ->innerJoin('sub.categorie', 'subC')
            ->where('subC.slug = :categoryName')
            ->setParameter('categoryName', $categoryName)
            ->getQuery();
    
        $lastArticleDate = $subQueryBuilder->getSingleScalarResult();
    
        // Requête principale pour obtenir tous les articles sauf le plus récent
        $qb = $this->createQueryBuilder('a')
            ->innerJoin('a.categorie', 'c')
            ->where('c.slug = :categoryName')
            ->setParameter('categoryName', $categoryName);
    
        if ($lastArticleDate) {
            $qb->andWhere('a.date_creation != :lastArticleDate')
               ->setParameter('lastArticleDate', $lastArticleDate);
        }
    
        $qb->orderBy('a.date_creation', 'DESC');
    
        return $qb->getQuery();
    }
      

    public function findLatestArticlesExceptCurrent($currentArticleId, $limit = null): array
    {
        $qb = $this->createQueryBuilder('a')
            ->innerJoin('a.categorie', 'c') // Effectue une jointure avec l'entité Catégorie
            ->where('a.publication = :isPublished')
            ->andWhere('a.id != :currentArticleId') // Exclut l'article actuel
            ->setParameter('isPublished', true)
            ->setParameter('currentArticleId', $currentArticleId)
            ->orderBy('a.date_creation', 'DESC'); // Assurez-vous que 'dateCreation' est le bon nom du champ
    

        if ($limit) {
            $qb->setMaxResults($limit);
        }

        return $qb->getQuery()->getResult();
    }


    public function findLastArticleFromCategory($categoryName)
    {
        $qb = $this->createQueryBuilder('a')
            ->innerJoin('a.categorie', 'c')
            ->where('c.slug = :categoryName')
            ->andWhere('a.publication = :isPublished')
            ->setParameter('categoryName', $categoryName)
            ->setParameter('isPublished', true)
            ->orderBy('a.date_creation', 'DESC')
            ->setMaxResults(1); // Pour ne récupérer que le plus récent

        return $qb->getQuery()->getOneOrNullResult();
    }



}
