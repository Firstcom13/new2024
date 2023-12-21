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
            ->select('DISTINCT c.nom') // Sélectionne les noms de catégories distincts
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
        return $this->createQueryBuilder('a')
            ->innerJoin('a.categorie', 'c') // Assurez-vous que 'categorie' est le nom correct de la propriété dans ArticlesBlog.
            ->where('c.nom = :categoryName') // Remplacez 'nom' par le champ réel dans Categorie qui contient le nom.
            ->setParameter('categoryName', $categoryName)
            ->getQuery();
    }

}
