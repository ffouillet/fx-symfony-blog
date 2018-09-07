<?php

namespace Fx\BlogBundle\Controller;

use Fx\BlogBundle\Entity\Post;
use Fx\BlogBundle\Entity\Comment;
use Fx\BlogBundle\Form\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        //TODO : Ajouter une pagination.

        $posts = $em->getRepository('FxBlogBundle:Post')->findBy([],['createdAt' => 'DESC']);

        return $this->render('fx/blog.html.twig',
            array('posts' => $posts));
    }

    public function viewPostAction(Post $post){

        $em = $this->getDoctrine()->getManager();

        // On récupère les commentaires valides du post, triés par date DESC.
        $postComments = $em->getRepository('FxBlogBundle:Comment')->getPostCommentsForDisplay($post);

        // On crée un objet commentaire pour pouvoir en ajouter via le formulaire.
        $comment = new Comment();
        $comment->setPost($post);

        $commentForm = $this->get('form.factory')->create(CommentType::class, $comment);

        // On récupère l'objet de formulaire pour les commentaire.
        return $this->render('fx/blog-post.html.twig',
            array('commentForm' => $commentForm->createView(),
                'post' => $post,
                'postComments' => $postComments));
    }


}
