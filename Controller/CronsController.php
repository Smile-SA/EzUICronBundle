<?php

namespace Smile\EzUICronBundle\Controller;

use eZ\Publish\API\Repository\Exceptions\InvalidArgumentException;
use eZ\Publish\Core\Base\Exceptions\NotFoundException;
use eZ\Publish\Core\MVC\Symfony\Security\Authorization\Attribute;
use EzSystems\PlatformUIBundle\Controller\Controller;
use Smile\EzUICronBundle\Service\EzCronService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Translation\TranslatorInterface;

class CronsController extends Controller
{
    /** @var EzCronService $cronService cron service */
    protected $cronService;

    /** @var TranslatorInterface $translator */
    protected $translator;

    public function __construct(
        EzCronService $cronService,
        TranslatorInterface $translator
    ) {
        $this->cronService = $cronService;
        $this->translator = $translator;
    }

    public function performAccessChecks()
    {
        parent::performAccessChecks();
        $this->denyAccessUnlessGranted(new Attribute('uicron', 'cron'));
    }

    public function listAction()
    {
        $crons = $this->cronService->getCrons();

        return $this->render('SmileEzUICronBundle:cron:tab/crons/list.html.twig', [
            'datas' => $crons
        ]);
    }

    public function editAction(Request $request, $type, $alias)
    {
        $value = $request->get('value');

        $response = new Response();

        try {
            $this->cronService->updateCron($alias, $type, $value);
            $response->setStatusCode(
                200,
                $this->translator->trans('cron.edit.done', ['%type%' => $type, '%alias%' => $alias], 'smileezcron')
            );
        } catch (NotFoundException $e) {
            $response->setStatusCode(500, $e->getMessage());
        } catch (InvalidArgumentException $e) {
            $response->setStatusCode(500, $e->getMessage());
        }

        return $response;
    }
}
