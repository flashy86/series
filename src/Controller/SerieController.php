<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
	public function create(int $id):Response{

		return $this->render('series/create.html.twig', [

		]);
	}

}