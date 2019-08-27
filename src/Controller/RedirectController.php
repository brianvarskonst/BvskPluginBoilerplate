<?php declare(strict_types=1);

namespace Bvsk\PluginBoilerplate\Controller;

use Bvsk\PluginBoilerplate\Component\RedirectHandler\RedirectHandler;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

class RedirectController
{
    /**
     * @var RedirectHandler
     */
    private $redirectHandler;

    public function __construct(RedirectHandler $redirectHandler)
    {
        $this->redirectHandler = $redirectHandler;
    }

    /**
     * @Route("/boilerplate/redirect", name="boilerplate_redirect")
     */
    public function execute(Request $request): Response
    {
        $hash = $request->get('hash');

        if (empty($hash)) {
            throw new NotFoundHttpException();
        }

        try {
            $target = $this->redirectHandler->decode($hash);
        } catch (Throwable $exception) {
            throw new NotFoundHttpException();
        }

        return new RedirectResponse($target);
    }

}