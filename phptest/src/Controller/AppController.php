<?php
namespace App\Controller;
use App\Entity\Task;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
//to restrict methods based on the type of route
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class AppController extends Controller{
	/**
		* @Route("/")
		* @Method({"GET"})
	*/
 	
	public function index(){

		return $this->render('home/index.html.twig');
    
	}

	/**
		* @Route("/home/task" , name="alltask")
		* @Method({"GET"})
	*/

 	//pass user id to get the task related to that user also need to pass it on the link
	public function alltask(){
		$tasks = $this->getDoctrine()->getRepository(Task::class)->findAll();
		return $this->render('home/task.html.twig', array('tasks'=> $tasks));
	}

	/**
		* @Route("/home/login")
		* @Method({"POST"})
	*/
 	
	public function login(){
		return $this->render('home/login.html.twig');
    
	}


	// public function new(Request $request){
	// 	$user = new User();
	// 	$form = $this->createFormBuilder($user)
	// 	->add('username', TextType::class, array('attr' => array('class' => 'form-control'))) 
	// 	->add('password', TextType::class, array('attr' => array('class' => 'form-control'))) 
	// 	->add('Login', SubmitType::class, array('label' => 'Add', 'attr' => array('class' => 'btn btn-primary mt-3')))
	// 	->getForm();

	// 	$form->handleRequest($request);

	// 	if($form->isSubmitted() && $form->isValid()){
	// 		$user = $form->getData();

	// 		$entityManager = $this->getDoctrine()->getManager();
 //        $entityManager->persist($user);
 //        $entityManager->flush();
 //        return $this->redirectToRoute('alltask');
	// 	}

	// 	return $this->render('home/newtask.html.twig', array('form' => $form->createView()));
	// }

	/**
	 * @Route("/home/addTask")
	 *Method{{"GET", "POST"}}
	*/

	public function new(Request $request){
		$task = new Task();
		$form = $this->createFormBuilder($task)
		->add('description', TextType::class, array('attr' => array('class' => 'form-control'))) 
		->add('save', SubmitType::class, array('label' => 'Add', 'attr' => array('class' => 'btn btn-primary mt-3')))
		->getForm();

		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid()){
			$task = $form->getData();

			$entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($task);
        $entityManager->flush();
        return $this->redirectToRoute('alltask');
		}

		return $this->render('home/newtask.html.twig', array('form' => $form->createView()));
	}


	 /**
     * @Route("/task/delete/{id}")
     * @Method({"DELETE"})
     */
    public function delete(Request $request, $id) {
      $task = $this->getDoctrine()->getRepository(Task::class)->find($id);
      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->remove($task);
      $entityManager->flush();
      $response = new Response();
      $response->send();
    }

	// /**
	// 	* @Route("/task/save")
	// */

	// public function save(){
	// 	$entityManager = $this->getDoctrine()->getManager();

	// 	$task = new Task();
	// 	$task-> setdescription('Email John about the quote');

	// 	$entityManager->persist($task);
	// 	$entityManager->flush();

	// 	return new Response('Saves a task with the id of'.$task->getId());
	// }
}
