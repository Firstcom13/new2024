<?php

namespace App\Command;

use App\Entity\ArticlesBlog;
use Doctrine\ORM\EntityManagerInterface;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:repair-translations')]
class RepairTranslationsCommand extends Command
{
    public function __construct(private EntityManagerInterface $em)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // On récupère les articles.
        // ATTENTION : S'ils sont déjà en Anglais en base, getTitre() renverra de l'anglais.
        $articles = $this->em->getRepository(ArticlesBlog::class)->findAll();

        $tr = new GoogleTranslate('fr'); // On traduit de EN vers FR
        $tr->setSource('en');

        $output->writeln('<info>Début de la réparation...</info>');

        foreach ($articles as $article) {
            $currentTitle = $article->getTitre(); // Actuellement en Anglais (si écrasé)
            $currentContent = $article->getContenu();

            if (!$currentTitle) continue;

            $output->writeln("Traitement : " . substr($currentTitle, 0, 20));

            // ÉTAPE A : RESTAURER LE FRANÇAIS (Base principale)
            // -------------------------------------------------
            try {
                // Si le titre est déjà en français (pas écrasé), on garde, sinon on traduit
                // Petite astuce : on peut détecter si c'est anglais, mais simplifions : on re-traduit.
                $titreFr = $tr->translate($currentTitle);
                $contenuFr = $currentContent ? $tr->translate($currentContent) : '';
            } catch (\Exception $e) {
                continue;
            }

            // On force la locale FR pour écrire dans la table articles_blog
            $article->setTranslatableLocale('fr');
            $article->setTitre($titreFr);
            $article->setContenu($contenuFr);

            $this->em->persist($article);
            $this->em->flush(); // FORCE L'ÉCRITURE DU FR DANS LA TABLE PRINCIPALE

            // ÉTAPE B : CRÉER L'ANGLAIS (Table ext_translations)
            // --------------------------------------------------
            // On définit la locale sur EN. Gedmo VA INTERCEPTER CECI grâce à l'attribut TranslationEntity
            $article->setTranslatableLocale('en');
            $article->setTitre($currentTitle); // On remet le texte anglais d'origine
            $article->setContenu($currentContent);

            $this->em->persist($article);
            $this->em->flush(); // FORCE L'ÉCRITURE DANS EXT_TRANSLATIONS

            // ÉTAPE C : NETTOYAGE MÉMOIRE
            // Pour éviter que Doctrine ne s'emmêle les pinceaux entre les deux locales
            $this->em->refresh($article);
        }

        $output->writeln('<info>Terminé.</info>');
        return Command::SUCCESS;
    }
}
