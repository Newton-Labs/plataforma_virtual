<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{

    public function __construct($environment, $debug)
    {
        date_default_timezone_set('America/Guatemala');
        parent::__construct($environment, $debug);
    }
    
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            
           
            new FOS\UserBundle\FOSUserBundle(),                         //user bunndle
            new JavierEguiluz\Bundle\EasyAdminBundle\EasyAdminBundle(), //admin bundle
            new FOS\RestBundle\FOSRestBundle(),
            new FOS\CommentBundle\FOSCommentBundle(),                   //forum bundle
            new JMS\SerializerBundle\JMSSerializerBundle($this),
            new Vich\UploaderBundle\VichUploaderBundle(),               //upload engine
            new Genemu\Bundle\FormBundle\GenemuFormBundle(),            //Add select2
            new Braincrafted\Bundle\BootstrapBundle\BraincraftedBootstrapBundle(),
            new Lexik\Bundle\TranslationBundle\LexikTranslationBundle(),//translation bundle
            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),//soft delete bundle
            new Knp\Bundle\GaufretteBundle\KnpGaufretteBundle(),
            new Voryx\RESTGeneratorBundle\VoryxRESTGeneratorBundle(),
            new Nelmio\ApiDocBundle\NelmioApiDocBundle(),
            new Nelmio\CorsBundle\NelmioCorsBundle(),
            new cspoo\Swiftmailer\MailgunBundle\cspooSwiftmailerMailgunBundle(),
            
            new CursoBundle\CursoBundle(),
            new UserBundle\UserBundle(),
            new DocumentBundle\DocumentBundle(),
            new ForumBundle\ForumBundle(),
            new TutoriaBundle\TutoriaBundle(),
            new ContactBundle\ContactBundle(),
            new ReportBundle\ReportBundle(),
            
            new blackknight467\StarRatingBundle\StarRatingBundle(),
            new AppBundle\AppBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
            $bundles[] = new Hautelook\AliceBundle\HautelookAliceBundle();
            $bundles[] = new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle();
          
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');
    }
}
