<?php
namespace Qinx\Qxnewsletter\Tests\Unit\Controller;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016 Christian Pschorr <hello@qinx.me>
 *  			
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Test case for class Qinx\Qxnewsletter\Controller\NewsletterController.
 *
 * @author Christian Pschorr <hello@qinx.me>
 */
class NewsletterControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{

	/**
	 * @var \Qinx\Qxnewsletter\Controller\NewsletterController
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = $this->getMock('Qinx\\Qxnewsletter\\Controller\\NewsletterController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllNewslettersFromRepositoryAndAssignsThemToView()
	{

		$allNewsletters = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$newsletterRepository = $this->getMock('Qinx\\Qxnewsletter\\Domain\\Repository\\NewsletterRepository', array('findAll'), array(), '', FALSE);
		$newsletterRepository->expects($this->once())->method('findAll')->will($this->returnValue($allNewsletters));
		$this->inject($this->subject, 'newsletterRepository', $newsletterRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newsletters', $allNewsletters);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenNewsletterToView()
	{
		$newsletter = new \Qinx\Qxnewsletter\Domain\Model\Newsletter();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('newsletter', $newsletter);

		$this->subject->showAction($newsletter);
	}
}
