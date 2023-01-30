<?php
/**
 * Html2Pdf Library - Tests
 *
 * HTML => PDF converter
 * distributed under the OSL-3.0 License
 *
 * @package   Html2pdf
 * @author    Laurent MINGUET <webmaster@html2pdf.fr>
 * @copyright 2017 Laurent MINGUET
 */

namespace Spipu\Html2Pdf\Tests\CrossVersionCompatibility;

use Spipu\Html2Pdf\Parsing\TagParser;

abstract class TagParserTestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * @var TagParser
     */
    protected $parser;

    protected function setUp(): void
    {
        $textParser = $this->getMockBuilder('Spipu\Html2Pdf\Parsing\TextParser')
            ->disableOriginalConstructor()
            ->setMethods(['prepareTxt'])
            ->getMock();

        $textParser
            ->expects($this->any())
            ->method('prepareTxt')
            ->willReturnCallback([$this, 'mockPrepareTxt']);

        $this->parser = new TagParser($textParser);
    }
}
