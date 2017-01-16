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

/**
 * Class CronsController
 *
 * @package Smile\EzUICronBundle\Controller
 */
class CronsController extends Controller
{
    /** @var EzCronService $cronService cron service */
    protected $cronService;

    /** @var TranslatorInterface $translator */
    protected $translator;

    /**
     * CronsController constructor.
     *
     * @param EzCronService       $cronService
     * @param TranslatorInterface $translator
     */
    public function __construct(
        EzCronService $cronService,
        TranslatorInterface $translator
    ) {
        $this->cronService = $cronService;
        $this->translator = $translator;
    }

    /**
     * Perform access control to cron policy
     */
    public function performAccessChecks()
    {
        parent::performAccessChecks();
        $this->denyAccessUnlessGranted(new Attribute('uicron', 'cron'));
    }

    /**
     * List crons definition
     *
     * @return Response
     */
    public function listAction()
    {
        $crons = $this->cronService->getCrons();

        return $this->render('SmileEzUICronBundle:cron:tab/crons/list.html.twig', [
            'datas' => $crons
        ]);
    }

    /**
     * Edition cron definition
     *
     * @param Request $request
     * @param string  $type cron property identifier
     * @param string  $alias cron alias identifier
     * @return Response
     */
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
