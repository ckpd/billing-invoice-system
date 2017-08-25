<?php
require_once('includes/autoload.php');

/*******************************************************************************
* PHP Invoice                                                                  *
*                                                                              *
* Version: 1.0	                                                               *
* Author:  Farjad Tahir	                                    				   *
* http://www.splashpk.com                                                      *
*******************************************************************************/

class invoice extends FPDF_rotation  {

	private $font 			 = 'helvetica';	 	/* Font Name : See inc/fpdf/font for all supported fonts */
	private $columnOpacity   = 0.06;		 	/* Items table background color opacity. Range (0.00 - 1) */
	private $columnSpacing   = 0.3;			 	/* Spacing between Item Tables */
	private $referenceformat = array('.',',');	/* Currency formater */
	private $margins 		 = array('l' => 15,
									 't' => 15,
									 'r' => 15); /* l: Left Side , t: Top Side , r: Right Side */

	public $lang;
	public $document;
	public $type;
	public $reference;
	public $logo;
	public $color;
	public $date;
	public $time;
	public $due;
	public $from;
	public $to;
	public $items;
	public $totals;
	public $badge;
	public $addText;
	public $footernote;
	public $dimensions;
	public $display_tofrom = true;
	
   /******************************************
    * Class Constructor               		 *
	* param : Page Size , Currency, Language *
    ******************************************/
	public function __construct($size='A4',$currency='$',$language='en') {
		$this->columns  		  	= 4;
		$this->items 			  	= array();
		$this->totals 			  	= array();
		$this->addText 			  	= array();
		$this->firstColumnWidth   	= 70;
		$this->currency 		  	= $currency;
		$this->maxImageDimensions 	= array(230,130);
		$this->setLanguage($language);
		$this->setDocumentSize($size);
		$this->setColor("#222222");
        $pdf = new FPDF('P','mm','A4');
		$this->AliasNbPages();
		$this->SetMargins($this->margins['l'],$this->margins['t'],$this->margins['r']);
	}

	private function setLanguage($language) {
		$this->language = $language;
			include('includes/languages/'.$language.'.inc');
		$this->lang = $lang;
	}
	
	private function setDocumentSize($dsize) {
		switch ($dsize) {
			case 'A4':
				$document['w'] = 210;
				$document['h'] = 297;
				break;
			case 'letter':
				$document['w'] = 215.9;
				$document['h'] = 279.4;
				break;
			case 'legal':
				$document['w'] = 215.9;
				$document['h'] = 355.6;
				break;
			default:
				$document['w'] = 210;
				$document['h'] = 297;
				break;
		}
		$this->document = $document;
	}
	
	private function resizeToFit($image) {
		
	}
	    
	private function pixelsToMM($val){
		$mm_inch = 25.4;
		$dpi = 96;
		return ($val * $mm_inch)/$dpi;
	}
	
	private function hex2rgb($hex) {
	   $hex = str_replace("#", "", $hex);
	   if(strlen($hex) == 3) {
	      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
	      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
	      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
	   } else {
	      $r = hexdec(substr($hex,0,2));
	      $g = hexdec(substr($hex,2,2));
	      $b = hexdec(substr($hex,4,2));
	   }
	   $rgb = array($r, $g, $b);
	   return $rgb;
	}
	
	private function br2nl($string) {
    	return preg_replace('/\<br(\s*)?\/?\>/i', "\n", $string);
	}  

	public function isValidTimezoneId($zone) {
		try{ new DateTimeZone($zone); }
		catch(Exception $e){ return FALSE; }
		return TRUE;
	} 

	public function setTimeZone($zone = "") {
		if(!empty($zone) and $this->isValidTimezoneId($zone) === TRUE) {
			date_default_timezone_set($zone);
		}
	}
	
	public function setType($title) {
		$this->title = $title;
	}
	
	public function setColor($rgbcolor) {
		$this->color = $this->hex2rgb($rgbcolor);
	}
	
	public function setDate($date) {
		$this->date = $date;
	}

	public function setTime($time) {
		$this->time = $time;
	}
	
	public function setDue($date) {
		$this->due = $date;
	}
	
	
	public function hide_tofrom() {
		$this->display_tofrom = false;
	}
	
	public function setFrom($data) {
		$this->from = $data;
	}
	
	public function setTo($data) {
		$this->to = $data;
	}
	
	public function setReference($reference) {
		$this->reference = $reference;
	}
	
	public function setNumberFormat($decimals,$thousands_sep) {
		$this->referenceformat = array($decimals,$thousands_sep);
	}
	
	public function flipflop() {
		$this->flipflop = true;
	}
	
	public function addItem($item,$description = "",$quantity,$price = 0,$total) {
		$p['item'] 			= $item;
		$p['description'] 	= $this->br2nl($description);
		

		$p['quantity'] 		= $quantity;
		$p['price']			= $price;
		$p['total']			= $total;
		
		$this->items[]		= $p;
	}
	
	public function addTotal($name,$value,$colored = FALSE) {
		$t['name']			= $name;
		$t['value']			= $value;
		if(is_numeric($value)) {
			$t['value']			= $this->currency.' '.number_format($value,2,$this->referenceformat[0],$this->referenceformat[1]);
		} 
		$t['colored']		= $colored;
		$this->totals[]		= $t;
	}
	
	public function addTitle($title) {
		$this->addText[] = array('title',$title);
	}
	
	public function addParagraph($paragraph) {
		$paragraph = $this->br2nl($paragraph);
		$this->addText[] = array('paragraph',$paragraph);
	}
	
	public function addBadge($badge) {
		$this->badge = $badge;
	}
	
	public function setFooternote($note) {
		$this->footernote = $note;
	}
	
	public function render($name='',$destination='') {
		$this->AddPage();
		$this->Body();
		$this->AliasNbPages();
		$this->Output($name,$destination);
	}
	
	public function Header() {
	    if(isset($this->logo) and !empty($this->logo)) {
	    	$this->Image($this->logo,$this->margins['l'],$this->margins['t'],$this->dimensions[0],$this->dimensions[1]);
	    }
		
	    //Title
		$this->SetTextColor(0,0,0);
		$this->SetFont($this->font,'B',20);
	    $this->Cell(0,5,iconv("UTF-8", "ISO-8859-1",strtoupper($this->title)),0,1,'R');
		$this->SetFont($this->font,'',9);
		$this->Ln(5);
		
		$lineheight = 5;
		//Calculate position of strings
		$this->SetFont($this->font,'B',9);
		$positionX = $this->document['w']-$this->margins['l']-$this->margins['r']-max(strtoupper($this->GetStringWidth($this->lang['number'])),
					 strtoupper($this->GetStringWidth($this->lang['date'])),
					 strtoupper($this->GetStringWidth($this->lang['due'])))-35;
		
	    //Number
		if(!empty($this->reference)) {
		  $this->Cell($positionX,$lineheight);
		  $this->SetTextColor($this->color[0],$this->color[1],$this->color[2]);
		  $this->Cell(32,$lineheight,iconv("UTF-8", "ISO-8859-1",strtoupper($this->lang['number']).':'),0,0,'L');
		  $this->SetTextColor(50,50,50);
		  $this->SetFont($this->font,'',9);
		  $this->Cell(0,$lineheight,$this->reference,0,1,'R');
		}
		//Date
		$this->Cell($positionX,$lineheight);
		$this->SetFont($this->font,'B',9);
		$this->SetTextColor($this->color[0],$this->color[1],$this->color[2]);
		$this->Cell(32,$lineheight,iconv("UTF-8", "ISO-8859-1",strtoupper($this->lang['date'])).':',0,0,'L');	
		$this->SetTextColor(50,50,50);
		$this->SetFont($this->font,'',9);
		$this->Cell(0,$lineheight,$this->date,0,1,'R');

		//Time
		if(!empty($this->time)){
		  $this->Cell($positionX,$lineheight);
		  $this->SetFont($this->font,'B',9);
		  $this->SetTextColor($this->color[0],$this->color[1],$this->color[2]);
		  $this->Cell(32,$lineheight,iconv("UTF-8", "ISO-8859-1",strtoupper($this->lang['time'])).':',0,0,'L');	
		  $this->SetTextColor(50,50,50);
		  $this->SetFont($this->font,'',9);
		  $this->Cell(0,$lineheight,$this->time,0,1,'R');
		}
		//Due date
		if(!empty($this->due)){
			$this->Cell($positionX,$lineheight);
			$this->SetFont($this->font,'B',9);
			$this->SetTextColor($this->color[0],$this->color[1],$this->color[2]);
			$this->Cell(32,$lineheight,iconv("UTF-8", "ISO-8859-1",strtoupper($this->lang['due'])).':',0,0,'L');	
			$this->SetTextColor(50,50,50);
			$this->SetFont($this->font,'',9);
			$this->Cell(0,$lineheight,$this->due,0,1,'R');
		}
		
		//First page
		if($this->PageNo()== 1) {
			if(($this->margins['t']+$this->dimensions[1]) > $this->GetY()) {
				$this->SetY($this->margins['t']+$this->dimensions[1]+5);
			} 
			else  {
				$this->SetY($this->GetY()+10);
			}
			$this->Ln(5);
			$this->SetFillColor($this->color[0],$this->color[1],$this->color[2]);
			$this->SetTextColor($this->color[0],$this->color[1],$this->color[2]);
			
			$this->SetDrawColor($this->color[0],$this->color[1],$this->color[2]);
			$this->SetFont($this->font,'B',10);
			$width = ($this->document['w']-$this->margins['l']-$this->margins['r'])/2;
			if(isset($this->flipflop)) {
				$to   				= $this->lang['to'];
				$from 				= $this->lang['from'];
				$this->lang['to'] 	= $from;
				$this->lang['from'] = $to;
				$to 				= $this->to;
				$from 				= $this->from;
				$this->to 			= $from;
				$this->from 		= $to;
			}
			
			if($this->display_tofrom === true) {
				$this->Cell($width,$lineheight,strtoupper($this->lang['from']),0,0,'L');
				$this->Cell(0,$lineheight,strtoupper($this->lang['to']),0,0,'L');
				$this->Ln(7);
				$this->SetLineWidth(0.4);
				$this->Line($this->margins['l'], $this->GetY(),$this->margins['l']+$width-10, $this->GetY());
				$this->Line($this->margins['l']+$width, $this->GetY(),$this->margins['l']+$width+$width, $this->GetY());
	
				//Information
				$this->Ln(5);
				$this->SetTextColor(50,50,50);
				$this->SetFont($this->font,'B',10);
				$this->Cell($width,$lineheight,$this->from[0],0,0,'L');
				$this->Cell(0,$lineheight,$this->to[0],0,0,'L');
				$this->SetFont($this->font,'',8);
				$this->SetTextColor(100,100,100);
				$this->Ln(7);
				for($i=1; $i<max(count($this->from),count($this->to)); $i++) {
					$this->Cell($width,$lineheight,iconv("UTF-8", "ISO-8859-1",$this->from[$i]),0,0,'L');
					$this->Cell(0,$lineheight,iconv("UTF-8", "ISO-8859-1",$this->to[$i]),0,0,'L');
					$this->Ln(5);
				}	
				$this->Ln(-6);
				$this->Ln(5);
			}else{
				$this->Ln(-10);
			}
		}
		//Table header
		if(!isset($this->productsEnded))  {
			$width_other = ($this->document['w']-$this->margins['l']-$this->margins['r']-$this->firstColumnWidth-($this->columns*$this->columnSpacing))/($this->columns-1);
			$this->SetTextColor(50,50,50);
			$this->Ln(12);
			$this->SetFont($this->font,'B',9);
			$this->Cell(1,10,'',0,0,'L',0);
			$this->Cell($this->firstColumnWidth,10,iconv("UTF-8", "ISO-8859-1",strtoupper($this->lang['product'])),0,0,'L',0);
			$this->Cell($this->columnSpacing,10,'',0,0,'L',0);
			$this->Cell($width_other,10,iconv("UTF-8", "ISO-8859-1",strtoupper($this->lang['qty'])),0,0,'C',0);
			if(isset($this->vatField)) {
				$this->Cell($this->columnSpacing,10,'',0,0,'L',0);
				$this->Cell($width_other,10,iconv("UTF-8", "ISO-8859-1",strtoupper($this->lang['vat'])),0,0,'C',0);
			}
			$this->Cell($this->columnSpacing,10,'',0,0,'L',0);
			$this->Cell($width_other,10,iconv("UTF-8", "ISO-8859-1",strtoupper($this->lang['price'])),0,0,'C',0);
			if(isset($this->discountField)) {
				$this->Cell($this->columnSpacing,10,'',0,0,'L',0);
				$this->Cell($width_other,10,iconv("UTF-8", "ISO-8859-1",strtoupper($this->lang['discount'])),0,0,'C',0);
			}
			$this->Cell($this->columnSpacing,10,'',0,0,'L',0);
			$this->Cell($width_other,10,iconv("UTF-8", "ISO-8859-1",strtoupper($this->lang['total'])),0,0,'C',0);
			$this->Ln();
			$this->SetLineWidth(0.3);
			$this->SetDrawColor($this->color[0],$this->color[1],$this->color[2]);
			$this->Line($this->margins['l'], $this->GetY(),$this->document['w']-$this->margins['r'], $this->GetY());
			$this->Ln(2);	
		} else {
			$this->Ln(12);	
		}
	}
	
	public function Body() {	


	public function Footer() {
		$this->SetY(-$this->margins['t']);
		$this->SetFont($this->font,'',8);
		$this->SetTextColor(50,50,50);
		$this->Cell(0,10,$this->footernote,0,0,'L');
		$this->Cell(0,10,$this->lang['page'].' '.$this->PageNo().' '.$this->lang['page_of'].' {nb}',0,0,'R');
	}

}
?>