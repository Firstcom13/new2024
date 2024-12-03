<?php



namespace App\EventListener;

use Presta\SitemapBundle\Event\SitemapPopulateEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use App\Repository\ArticlesBlogRepository; 
use Symfony\Component\String\Slugger\SluggerInterface;
use Presta\SitemapBundle\Sitemap\Url\UrlConcrete;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

#[AsEventListener(event: SitemapPopulateEvent::class, method: 'onSitemapPopulate')]
class SitemapEventListener
{

    public function __construct(
        private ArticlesBlogRepository $articlesRepository,
        private SluggerInterface $slugger
    ) {}


   public function onSitemapPopulate(SitemapPopulateEvent $event) : void 
   {
    $articles = $this->articlesRepository->findAllArticles();

    $urlContainer = $event->getUrlContainer();
    $urlGenerator = $event->getUrlGenerator();

    foreach ($articles as $article){
        $titreNettoye = strip_tags($article->getTitre());
        $slug = $this->slugger->slug($titreNettoye)->lower();

        $url = new UrlConcrete($urlGenerator->generate("app_article_show", [
            'id' => $article->getId(),
            'slug' => $slug
        ], UrlGeneratorInterface::ABSOLUTE_URL));
        $urlContainer->addUrl($url, "blog");
    }

   }
}
