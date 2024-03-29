<?php
class Pagination {


    private $byPage; // int, Nombre d'enregistrement a afficher par page
    private $rows; // int, Nombre total d'enregistrement
    public $goFirst;// string, Caractere ou chaine de caractere pour aller a la premiere page
    public $goPrevious;// string, Caractere ou chaine de caractere pour aller a la page precedente
    public $goLast;// string, Caractere ou chaine de caractere pour aller a la derniere page
    public $goNext;// string, Caractere ou chaine de caractere pour aller a la page suivante
 
    public function __construct() {
        if(isset($_GET['p'])) {
            $this->currentPage = intval($_GET['p']);
        } else {
            $this->currentPage = '1';
        }
        $this->goFirst = '&lt;&lt;&nbsp;';
        $this->goPrevious = '&lt;';
        $this->goLast = '&nbsp;&gt;&gt;';
        $this->goNext = '&gt;';
    }
 
    public function __set($var, $value) {
        $this->$var = intval($value);
    }
 
    public function __get($var) {
        if(isset($this->$var)) {
            return $this->$var;
        }
    }
    /*
    // Retourne le nombre de page
    // return int
    */
    private function pagesCount()
    {
        $pagesCount = ceil($this->rows / $this->byPage);
        return $pagesCount;
    }
    /*
    // Calcule le point de depart de la LIMIT d'une requete sql
    // en fonction de la page actuelle et du nombre d'enregistrement voulu
    // return int
    */
    public function fromPagination() {
        if(!isset($this->pagesCount)) {
            $this->pagesCount = $this->pagesCount();
        }
        if($this->currentPage > 0 && $this->rows > 0) {
            if($this->currentPage > 0 && $this->currentPage <= $this->pagesCount) {
                $from = ($this->currentPage - 1) * $this->byPage;
            }
            else {
                $from = $this->currentPage * $this->byPage;
            }
        }
        else{
            $from = '0';
        }
		
        return $from;
    }
    /*
    // La pagination en elle meme
    // @param int $pageBefore: Nombre de page que l'on veu afficher avant la page actuelle (defaut: 10)
    // @param int $pageAfter: Nombre de page que l'on veu afficher apres la page actuelle  (defaut: 10)
    //
    // $array['page']: L'affichage de la page
    // $array['current']: defini a 1 pour la page actuelle, 0 pour les autres
    // $array['p']: Le numero de la page pour les lien
    //
    // return array   
    */
    public function pages($pageBefore = '5', $pageAfter = '5') {
        if(!isset($this->pagesCount)) {
            $this->pagesCount = $this->pagesCount();
        }
        if($this->pagesCount > '1') {
            $pages = array();
            if($this->currentPage > $this->pagesCount) {
                $this->currentPage = $this->pagesCount;
            }
            if ($this->currentPage > 1) {
                $pages[] = array('page' => $this->goFirst,
                'current' => '0',
                'p' => '1'
                );
                $previous = $this->currentPage - 1;
                $pages[] = array('page' => $this->goPrevious,
                'current' => '0',
                'p' => $previous
                );
            }
            if($this->pagesCount <= '1') {
                $pages[] = array('page' => '1',
                'current' => '0',
                'p' => '1'
                );
            }
            else {
                for($i = $this->currentPage - $pageBefore,$j = $this->currentPage + $pageAfter; $i < $j; $i++) {
                    if($i >= 1 && $i <= $this->pagesCount) {
                        if($i == $this->currentPage) {
                            $pages[] = array('page' => $this->currentPage,
                            'current' => '1',
                            'p' => $this->currentPage
                            );
                        }
                        else {
                            $pages[] = array('page' => $i,
                            'current' => '0',
                            'p' => $i
                            );
                        }
                    }
                }
            }
            if ($this->currentPage < $this->pagesCount) {
                if ($this->currentPage != $this->pagesCount)
                {
                    $next = $this->currentPage + 1;
                    $pages[] = array('page' => $this->goNext,
                    'current' => '0',
                    'p' => $next
                    );
                }
                $pages[] = array('page' => $this->goLast,
                'current' => '0',
                'p' => $this->pagesCount
                );
            }
            return $pages;
        }
    }
}
