<?php 

use PHPUnit\Framework\TestCase;

class clienteTest extends TestCase{
    private $palavra = 'teste';

    public function testQualPalavra(){
        $this->assertSame( $this->palavra,'teste');
    }
}

?>