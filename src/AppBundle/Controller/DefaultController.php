<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Request as SiteRequest;
use AppBundle\Form\Type\RequestFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $siteRequest = new SiteRequest();
        $form = $this->createForm(new RequestFormType(), $siteRequest);
        $form->handleRequest($request);
        $formError = false;

        if ($form->isSubmitted() && $form->isValid()) {
            $valid = true;
            $phone = $form->get('phone')->getData();
            $email = $form->get('email')->getData();

            if (empty($phone) && empty($email)) {
                $form->get('phone')->addError(new FormError('Пожалуйста, укажи свой номер мобильного телефона...'));
                $form->get('email')->addError(new FormError('...или адрес электронной почты.'));
                $valid = false;
            }

            if ($valid) {
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($siteRequest);
                $manager->flush();

                $this->sendRequestNotice($siteRequest);

                $this->addFlash('request_success', '<strong>Благодарим за заявку!</strong> В ближайшее время мы свяжемся с тобой, чтобы уточнить подробности заказа.');

                return $this->redirectToRoute('index');
            }
        }

        return $this->render('AppBundle:default:index.html.twig', array(
            'form' => $form->createView(),
            'form_error' => $formError
        ));
    }

    protected function sendRequestNotice(SiteRequest $request)
    {
        $mail = \Swift_Message::newInstance()
            ->setSubject('Заявка с сайта')
            ->setFrom('noreply@sibinfosystem.ru')
            ->setTo('manager@sibinfosystem.ru')
            ->setBody($this->renderView('AppBundle:default:request_mail.html.twig', array('request' => $request)), 'text/html');
        $this->get('mailer')->send($mail);
    }
} 