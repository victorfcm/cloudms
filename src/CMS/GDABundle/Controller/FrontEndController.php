<?php

namespace CMS\GDABundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class FrontEndController extends Controller
{
	/**
	 * @Route("/noticias")
	 * @Template
	 */
	public function noticiasAction()
	{
		$em = $this->getDoctrine()->getManager();
		$posttype = $em->getRepository('CMSStoreBundle:PostType')->findOneBySlug('noticias');
		
		$repository = $em->getRepository('CMSStoreBundle:Post');
		$noticias = $repository->createQueryBuilder('p')
					->where('p.postType = :postType')
					->orderBy('p.createdAt', 'DESC')
					->setParameter('postType', $posttype)
					->getQuery();
		
		return array('noticias' => $noticias->execute());
	}
	
	/**
	 * @Route("/frontend/vdz")
	 * @Template()
	 */
	public function vdzAction()
	{
		$url = 'http://www.vascodividazero.com.br/export_gda.php';
		$_get = file_get_contents($url);
		
		$xml = new \SimpleXMLElement($_get);
		
		return array('data' => $xml);
	}
	
    /**
     * @Route("/frontend/enquete")
     * @Template()
     */
    public function enqueteAction()
    {
    }

    /**
     * @Route("/frontend/caravanas")
     * @Template()
     */
    public function caravanaAction()
    {
		$em = $this->getDoctrine()->getManager();
		$posttype = $em->getRepository('CMSStoreBundle:PostType')->findOneBySlug('caravanas');
		
		$posts = $posttype->getPosts();
		
		return array("posts" => $posts);
    }

    /**
     * @Route("/frontend/calendario")
     * @Template()
     */
    public function calendarioAction()
    {
		$url_netvasco = 'http://netvasco.com.br/';
		$id_netvasco = 'box-proxjogo';
		$div_netvasco = '<div class="'.$id_netvasco.'">';
		$end_div_netvasco = '<div class="box-header">';
		
		$url_icones = 'http://aimore.org/escudos/';
		
		$html = file_get_contents($url_netvasco);
		$catchableDiv = $this->getContent($html, $div_netvasco, $end_div_netvasco);
		
		$fora = $casa = array();
		
		$casa['nome'] = $this->getContent($catchableDiv, '<strong>', ' x');
		$_n = $this->trataTxt(utf8_encode($casa['nome']));
		$casa['img'] = $url_icones.$_n.".gif";
		
		$fora['nome'] = $this->getContent($catchableDiv, 'x ', '</strong>');
		$_n = $this->trataTxt(utf8_encode($fora['nome']));
		$fora['img'] = $url_icones.$_n.".gif";
		
		$jogo = array();
		
		$jogo['campeonato'] = $this->getContent($catchableDiv, '<img src="/img/icon_acompanhe_camp.png" />', '<br />');
		$jogo['data'] = $this->getContent($catchableDiv, '<img src="/img/icon_acompanhe_dia.png" />', '<br />');
		$jogo['local'] = utf8_encode($this->getContent($catchableDiv, '<img src="/img/icon_acompanhe_hora.png" />', '</p>'));
		
		$proximo = array('times' => array('casa' => $casa, 'fora' => $fora), 'jogo' => $jogo);
		
		
		return array('proximo' => $proximo);
    }
    
    private function trataTxt($var) 
    {
		$array1 = array( "á", "à", "â", "ã", "ä", "é", "è", "ê", "ë", "í", "ì", "î", "ï", "ó", "ò", "ô", "õ", "ö", "ú", "ù", "û", "ü", "ç" 
		, "Á", "À", "Â", "Ã", "Ä", "É", "È", "Ê", "Ë", "Í", "Ì", "Î", "Ï", "Ó", "Ò", "Ô", "Õ", "Ö", "Ú", "Ù", "Û", "Ü", "Ç", " " ); 
		
		$array2 = array( "a", "a", "a", "a", "a", "e", "e", "e", "e", "i", "i", "i", "i", "o", "o", "o", "o", "o", "u", "u", "u", "u", "c" 
		, "A", "A", "A", "A", "A", "E", "E", "E", "E", "I", "I", "I", "I", "O", "O", "O", "O", "O", "U", "U", "U", "U", "C", "_" ); 
		
		$excepcionais = array('Botafogo' => 'Botafogo_RJ');
		
		if(in_array($var, array_keys($excepcionais)))
		{
			return $excepcionais[$var];
		}
		
		return str_replace( $array1, $array2, $var); 
	}
    
    private function getContent($src,$start,$end)
    {
		$txt = explode($start,$src);
		$txt2 = explode($end,$txt[1]);
		return trim($txt2[0]);
	}
}
