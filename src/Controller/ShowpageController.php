<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Routing\Annotation\Route;


class ShowpageController extends AbstractController
{
    /**
     * @Route("/showpage")
     *
     * @param $data
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index($data)
    {
        if ($data == 'status') {

            sleep(10);
            $filecontent = $this->filegetcontent();
            return $this->render('pages/showpage.html.twig', [
                'content' => $filecontent,
            ]);
        } else {
            $this->fileputcontent($data);
            sleep(10);
            $filecontent = $this->filegetcontent();
            return $this->render('pages/showpage.html.twig', [
                'content' => $filecontent,
            ]);
        }
    }

    public function filegetcontent(): string
    {
        $finder = new Finder();
        $files = $finder->name('file.txt')->in(__DIR__);
        foreach ($files as $file){
            $filecontent = $file->getContents();
        }
        return $filecontent;
    }

    public function fileputcontent(?string $string)
    {
        $f = fopen('/var/command.txt','w');
        fwrite($f, $string);
        fclose($f);
    }
}