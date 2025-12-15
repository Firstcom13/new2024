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
        $qb = $this->createQueryBuilder('a')
            ->addSelect('c')
            ->leftJoin('a.categorie', 'c')
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
            ->getQuery();

        $this->applyTranslationHints($qb);

        // Exécute la requête et obtient un seul résultat.
        // Si aucun article n'est trouvé, cela retournera 'null'.
        return $qb->getOneOrNullResult();
    }

    public function find($id, $lockMode = null, $lockVersion = null): ?ArticlesBlog
    {
        $qb = $this->createQueryBuilder('a')
            ->addSelect('c')
            ->leftJoin('a.categorie', 'c')
            ->where('a.id = :id')
            ->setParameter('id', $id);
        $query = $qb->getQuery();
        $this->applyTranslationHints($query);

        return $query->getOneOrNullResult();
    }

    /**
     * Retourne tableau de tous les articles 
     */
    public function findAllArticles(): array
    {

        $qb = $this->createQueryBuilder('a')
            ->addSelect('c')
            ->leftJoin('a.categorie', 'c')
            ->where('a.publication = :isPublished')
            ->setParameter('isPublished', true);

        // Ajout d'un tri par date de création, dans l'ordre décroissant
        $qb->orderBy('a.date_creation', 'DESC');

        $query = $qb->getQuery();
        $this->applyTranslationHints($query);

        return $query->getResult();
    }

    /**
     * Retourne une Query de tous les articles sauf le dernier pour la pagination
     */
    public function findAllExceptLastQuery(): Query
    {
        $lastArticle = $this->findLastArticle();

        $qb = $this->createQueryBuilder('a')
            ->addSelect('c')
            ->leftJoin('a.categorie', 'c')
            ->where('a.publication = :isPublished')
            ->setParameter('isPublished', true);

        if ($lastArticle) {
            $qb->andWhere('a.id != :lastArticleId')
                ->setParameter('lastArticleId', $lastArticle->getId());
        }

        // Ajout d'un tri par date de création, dans l'ordre décroissant
        $qb->orderBy('a.date_creation', 'DESC');

        $query = $qb->getQuery();
        $this->applyTranslationHints($query);

        return $query;
    }

    public function findAllCategories(): array
    {
        // Construire la requête avec Categorie comme racine pour pouvoir sélectionner l'entité
        $qb = $this->_em->createQueryBuilder()
            ->select('DISTINCT c')
            ->from('App\\Entity\\Categorie', 'c')
            ->innerJoin('c.date_creation', 'a') // relation inverse ManyToMany vers ArticlesBlog
            ->where('a.publication = :isPublished')
            ->setParameter('isPublished', true)
            ->orderBy('c.nom', 'ASC');

        $query = $qb->getQuery();
        $this->applyTranslationHints($query);

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
            ->addSelect('c')
            ->innerJoin('a.categorie', 'c')
            ->where('c.slug = :categoryName')
            ->setParameter('categoryName', $categoryName);

        if ($lastArticleDate) {
            $qb->andWhere('a.date_creation != :lastArticleDate')
                ->setParameter('lastArticleDate', $lastArticleDate);
        }

        $qb->orderBy('a.date_creation', 'DESC');

        $query = $qb->getQuery();
        $this->applyTranslationHints($query);

        return $query;
    }


    public function findLatestArticlesExceptCurrent($currentArticleId, $limit = null): array
    {
        $qb = $this->createQueryBuilder('a')
            ->addSelect('c')
            ->innerJoin('a.categorie', 'c') // Effectue une jointure avec l'entité Catégorie
            ->where('a.publication = :isPublished')
            ->andWhere('a.id != :currentArticleId') // Exclut l'article actuel
            ->setParameter('isPublished', true)
            ->setParameter('currentArticleId', $currentArticleId)
            ->orderBy('a.date_creation', 'DESC'); // Assurez-vous que 'dateCreation' est le bon nom du champ


        if ($limit) {
            $qb->setMaxResults($limit);
        }

        $query = $qb->getQuery();
        $this->applyTranslationHints($query);

        return $query->getResult();
    }


    public function findLastArticleFromCategory($categoryName)
    {
        $qb = $this->createQueryBuilder('a')
            ->addSelect('c')
            ->innerJoin('a.categorie', 'c')
            ->where('c.slug = :categoryName')
            ->andWhere('a.publication = :isPublished')
            ->setParameter('categoryName', $categoryName)
            ->setParameter('isPublished', true)
            ->orderBy('a.date_creation', 'DESC')
            ->setMaxResults(1); // Pour ne récupérer que le plus récent

        $query = $qb->getQuery();
        $this->applyTranslationHints($query);

        return $query->getOneOrNullResult();
    }

    private function applyTranslationHints($query): void
    {
        // Assure le chargement des traductions Gedmo (ext_translations)
        $query->setHint(\Doctrine\ORM\Query::HINT_CUSTOM_OUTPUT_WALKER, 'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker');
        $query->setHint(\Gedmo\Translatable\TranslatableListener::HINT_FALLBACK, 1);
    }
}
