<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Player;
use AppBundle\Form\PlayerType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class PlayerController extends Controller
{
    /**
     * @Route("/player/", name="player.list")
     * @Method({"GET"})
     */
    public function indexAction(Request $request)
    {
        $player = $this->getDoctrine()->getRepository(Player::class);
        return $this->render('player/list.html.twig', array(
            'players' => $player->findAll()
        ));
    }

    /**
     * @Route("/player/add", name="player.new")
     * @Method({"GET"})
     */
    public function newAction()
    {
        $player = new Player();
        $player->setSkillLevel(5);
        $form = $this->createForm(PlayerType::class, $player, array(
            'action' => $this->generateUrl('player.add')
        ));

        return $this->render('player/new.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @param Request $request
     * @Route("/player/add", name="player.add")
     * @Method({"POST"})
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request)
    {
        $player = new Player();
        $form = $this->createForm(PlayerType::class, $player);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $data = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($data);
            $em->flush();

            return $this->redirectToRoute("player.list");
        }

        return $this->render('player/new.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
