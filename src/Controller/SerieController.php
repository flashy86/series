<?php

namespace App\Controller;

use App\Entity\Serie;
use App\Form\SerieType;
use App\Repository\SerieRepository;
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
	public function list(SerieRepository $serieRepository):Response
	{
		$series = $serieRepository->findBestSeries();

		return $this->render('series/list.html.twig', [
			"series"=>$series
		]);
	}

	/**
	 * @Route ("/series/details/{id}", name="serie_details")
	 */
	public function details(int $id, SerieRepository $serieRepository):Response
	{
		$serie = $serieRepository->find($id);

		if (!$serie){
			throw $this->createNotFoundException
			('oh no!! The series does not exist, but you can create one if you want!! :-)');
		}

		return $this->render('series/details.html.twig', [
			"serie"=>$serie
		]);
	}

	/**
	 * @Route ("/series/create", name="serie_create")
	 */
	public function create(
		Request $request,
		EntityManagerInterface $entityManager
	):Response
	{
		$serie = new Serie();
		$serie->setDateCreated(new \DateTime());
		$serie->setBackdrop("backdrop");

		$serieForm = $this->createForm(SerieType::class, $serie);


		$serieForm->handleRequest($request);

		if ($serieForm->isSubmitted() && $serieForm->isValid()){

			$entityManager->persist($serie);
			$entityManager->flush();

			$this->addFlash('success', 'Serie added!! Good job :-)');
			return $this->redirectToRoute('serie_details', ['id' => $serie->getId()]);
		}

		//todo: traiter le formulaire


		return $this->render('series/create.html.twig', [
			'serieForm' => $serieForm->createView()
		]);
	}
	/**
	 * @Route ("/series/demo", name="serie_em-demo")
	 */
	public function demo(EntityManagerInterface $entityManager):Response
	{
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

		$entityManager->remove($serie);
		$entityManager->flush();

		return $this->render('series/create.html.twig', [

		]);
	}

	/**
	 * @Route ("/series/delete/{id}", name="serie_delete")
	 */
	public function delete(Serie $serie, EntityManagerInterface $entityManager)
	{
		//sinon, à la place d'injecter la série directement, on peut la recuper repository + find

		$entityManager->remove($serie);
		$entityManager->flush();
		return $this->redirectToRoute('main_home');
	}
}