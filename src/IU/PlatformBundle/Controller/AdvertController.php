<?php

namespace IU\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdvertController extends Controller
{
  public function indexAction($page){
    if($page < 0){
      throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
    }

    $listAdverts = array(
      array(
        'title'    => 'Recherche développeur Symfony',
        'id'       => 1,
        'author'   => 'Alexandre',
        'content'  => 'Nous recherchons un développeur Symfony débutant sur Lyon.',
        'date'     => new \Datetime()),
      array(
        'title'    => 'Mission de webmaster',
        'id'       => 2,
        'author'   => 'Hugo',
        'content'  => 'Nous recherchons un webmaster capable de maintenir notre site internet.',
        'date'     => new \Datetime())
    );

    return $this->render('IUPlatformBundle:Advert:index.html.twig', array(
      'listAdverts' => $listAdverts
    ));
  }

  public function viewAction($id){
    $advert = array(
      'title'    => 'Recherche développeur Symfony',
      'id'       => $id,
      'author'   => 'Alexandre',
      'content'  => 'Nous recherchons un développeur Symfony débutant sur Lyon.',
      'date'     => new \Datetime()
    );

    return $this->render('IUPlatformBundle:Advert:view.html.twig', array('advert' => $advert ));
  }

  public function addAction($id, Request $request){
    /* Si la requete est en POST, c'est que le visiteur a soumis le formulaire */
    if($request->isMethod('POST')){
      /* Ici, on s'occupera de la création et de la gestion du formulaire */
      $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
      /* Puis on redirige vers la page de visualisation de cette annonce */
      return $this->redirectToRoute('iu_platform_view', array('id' => 5));
    }
    /* Si on est pas en POST, alors on affiche le formulaire */
    return $this->render('IUPlatformBundle:Advert:add.html.twig');
  }

  public function editAction($id, Request $request){
    /* Ici, on récupèrera l'annonce correspondante à $id */
    /* Même mécanisme que pour l'ajout */
    if($request->isMethod('POST')){
      $request->getSession()->getFlashBag()->add('notice', 'Annonce bien modifiée.');

      return $this->redirectToRoute('iu_platform_view', array('id' => 5));
    }

    $advert = array(
      'title'    => 'Recherche développeur Symfony',
      'id'       => $id,
      'author'   => 'Alexandre',
      'content'  => 'Nous recherchons un développeur Symfony débutant sur Lyon',
      'date'     => new \Datetime()
    );

    return $this->render('IUPlatformBundle:Advert:edit.html.twig', array('advert' => $advert));
  }

  public function deleteAction($id){
    return $this->render('IUPlatformBundle:Advert:delete.html.twig');
  }

  public function menuAction($limit){
    $listAdverts = array(
      array('id' => 2, 'title' => 'Recherche développeur Symfony'),
      array('id' => 5, 'title' => 'Mission de webmaster'),
      array('id' => 9, 'title' => 'Offre de stage webdesigner')
    );

    return $this->render('IUPlatformBundle:Advert:menu.html.twig', array(
      'listAdverts' => $listAdverts 
    ));
  }
}