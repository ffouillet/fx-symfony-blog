<?php

namespace Fx\BlogBundle\Controller;

use Fx\BlogBundle\Entity\Post;
use Fx\BlogBundle\Entity\Comment;
use Fx\BlogBundle\Form\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class DefaultController extends Controller
{

    public function indexAction()
    {

        if (!$this->getParameter('fx_blog_enabled')) {
            throw $this->createNotFoundException('La page que vous demandez n\'existe pas :-(');
        }

        $em = $this->getDoctrine()->getManager();

        $posts = $em->getRepository('FxBlogBundle:Post')->findBy([],['createdAt' => 'DESC']);

        return $this->render('fx/blog.html.twig',
            array('posts' => $posts));
    }

    public function viewPostAction(Post $post, Request $request){

        if (!$this->getParameter('fx_blog_enabled')) {
            throw $this->createNotFoundException('La page que vous demandez n\'existe pas :-(');
        }

        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();

        // On récupère les commentaires valides du post, triés par date DESC.
        $postComments = $em->getRepository('FxBlogBundle:Comment')->getPostCommentsForDisplay($post);

        // On crée un objet commentaire pour pouvoir en ajouter via le formulaire.
        $comment = new Comment();
        $comment->setPost($post);

        $commentForm = $this->get('form.factory')->create(CommentType::class, $comment);
        $commentAddedSuccessfully = $this->handleCommentForm($commentForm, $request);

        if ($commentAddedSuccessfully === true) {
            $session->getFlashBag()->add('commentAddedSuccessfully',
                'Merci, votre commentaire a bien été pris en compte. Il sera visible après validation par un administrateur.');
        } else if($commentAddedSuccessfully === -1){
            $session->getFlashBag()->add('commentNotAdded',
                'Une erreur est survenue lors de l\'envoi de votre commentaire, merci de vérifier les données saisies.');
            dump('error');
        }

        // On récupère l'objet de formulaire pour les commentaire.
        return $this->render('fx/blog-post.html.twig',
            array('commentForm' => $commentForm->createView(),
                'post' => $post,
                'postComments' => $postComments));
    }

    public function handleCommentForm($commentForm, Request $request) {

        $em = $this->getDoctrine()->getManager();

        $commentAddedSuccessfully = false;

        $commentForm->handleRequest($request);

        if ($commentForm->isSubmitted()) {
            if ($commentForm->isValid()) {
                $comment = $commentForm->getData();

                $em->persist($comment);
                $em->flush();

                $commentAddedSuccessfully = true;
            } else {
                $commentAddedSuccessfully = -1;
            }
        }

        return $commentAddedSuccessfully;

    }


}
