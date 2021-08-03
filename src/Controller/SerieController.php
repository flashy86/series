<?php

namespace App\Controller;

use App\Entity\Serie;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SerieController extends AbstractController
{
	/**
	 * @Route ("/series", name="serie_list")
	 */
	public function list():Response{
		//todo: aller chercher les séries en bdd

		return $this->render('series/list.html.twig', [

		]);
	}

	/**
	 * @Route ("/series/details/{id}", name="serie_details")
	 */
	public function details(int $id):Response{
		//todo: aller chercher le détail des séries en bdd

		return $this->render('series/details.html.twig', [

		]);
	}

	/**
	 * @Route ("/create", name="serie_create")
	 */
	public function create(Request $request):Response{
		dump($request);
		return $this->render('series/create.html.twig', [

		]);
	}
	/**
	 * @Route ("/series/demo", name="serie_em-demo")
	 */
	public function demo(EntityManagerInterface $entityManager):Response{
		//démo pour entitymanager
		//création d'une instance de l'entité
		$serie = new Serie();

		//hydrater toutes les propriétés
		$serie->setName('pif');
		$serie->setBackdrop('dafsd');
		$serie->setPoster('dafsdf');
		$serie->setDateCreated(new \DateTime());
		$serie->setFirstAirDate(new \DateTime("-1year"));
		$serie->setLastAirDate(new  \DateTime("-6 month"));
		$serie->setGenres('drama');
		$serie->setOverview('bla bla bla');
		$serie->setPopularity(123.00);
		$serie->setVote(8.2);
		$serie->setStatus('cancelled');
		$serie->setTmdbId(329432);

		dump($serie);

		$entityManager->persist($serie);
		$entityManager->flush();

		dump($serie);

		$serie->setGenres('comedy');

		//$entityManager->remove($serie);
		$entityManager->flush();

		return $this->render('series/create.html.twig', [

		]);
	}

}