<?php
namespace Iwda\IwdaWord2digi\Controller;

use Iwda\IwdaWord2digi\Domain\Model\Dokument;
use Luracast\Restler\RestException;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class RestController {

     /**
    * @url POST dokument
    * @status 201
    *
    * @param Dokument $dokument {@type \Iwda\IwdaWord2digi\Domain\Model\Dokument}
    * @return Dokument {@type \Iwda\IwdaWord2digi\Domain\Model\Dokument}
    * @throws RestExeption 400 Dokument is not valid
    */
    public function saveDokument(Dokument $dokument)
    {
        
        $GLOBALS['TYPO3_DB']->store_lastBuiltQuery = 1; //Turn on Debug-mode
        
        $resnew = $GLOBALS['TYPO3_DB']->exec_SELECTquery('title', 'pages', 'title="'.$dokument->content[0][title].'" AND deleted=0','','','');
        $rownew = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($resnew);
            $datanew = $rownew;

        if (empty($datanew)) {

            $GLOBALS['TYPO3_DB']->exec_INSERTquery('pages', array(
                'title' => $dokument->content[0][title], 
                'pid' => $dokument->content[0][kategorieid],
                'hidden' => '1', 
                'description' => $dokument->content[0][description],
                'abstract' => $dokument->content[0][teaser],
                'doktype' => '1',
                'TSconfig' => '',
                'urltype' => '1',
                'fe_group' => '',
                'media' => '0',
                'keywords' => '',
                'l18n_cfg' => '2',
                'tsconfig_includes' => '',
                'tx_seo_titletag' => $dokument->content[0][title], 
                'tx_seo_canonicaltag' => '',
                'tx_hiteasermenu_images' => '',
                'tx_jhopengraphprotocol_ogtitle' => '',
                'tx_jhopengraphprotocol_ogfalimages' => '0',
                'tx_jhopengraphprotocol_ogdescription' => '',
                'tx_ratgeberportal_noindex' => '0',
                'tx_ratgeberportal_canonical' => '',
                'tx_ratgeberportal_related' => '',
                'tx_ratgeberportal_nofollow' => '0',
                'tx_ratgeberportal_allowcomments' => '0',
            ));

            $res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('uid', 'pages', 'title="'.$dokument->content[0][title].'" AND deleted=0','','','');
            $row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);
            $data = $row;

            $GLOBALS['TYPO3_DB']->exec_INSERTquery('tt_content', array(
                    'pid' => (int)$data['uid'],
                    'cType' => 'list',
                    'list_type' => 'rating_rating'
                )); 
            
            for ($i = 1; $i < count($dokument->content); $i++){

                // Speichert die H1-Überschrift in DB
                $GLOBALS['TYPO3_DB']->exec_INSERTquery('tt_content', array(
                    'pid' => (int)$data['uid'],
                    'header' => $dokument->content[$i][h1],
                    'CType' => 'header',
                    'rowDescription' => '',
                    'imagecols' => '2',
                    'header_layout' => '1',
                    'sectionIndex' => '1',
                    'l18n_diffsource' => '',
                    'tx_flux_column' => '',
                    'tx_flux_parent' => '0',
                    'tx_flux_children' => '0',

                ));  

                 // Speichert H2-Überschriften mit Text in DB
                 $GLOBALS['TYPO3_DB']->exec_INSERTquery('tt_content', array(
                    'pid' => (int)$data['uid'],
                    'bodytext' => $dokument->content[$i][p],
                    'header' => $dokument->content[$i][h2],
                    'CType' => 'textmedia',
                    'rowDescription' => '',
                    'imagecols' => '2',
                    'header_layout' => '0',
                    'sectionIndex' => '1',
                    'l18n_diffsource' => '',
                    'tx_flux_column' => '',
                    'tx_flux_parent' => '0',
                    'tx_flux_children' => '0',
                ));

                // Speichert H3-Überschriften mit Text in DB
                $GLOBALS['TYPO3_DB']->exec_INSERTquery('tt_content', array(
                    'pid' => (int)$data['uid'],
                    'bodytext' => $dokument->content[$i][p],
                    'header' => $dokument->content[$i][h3],
                    'CType' => 'textmedia',
                    'rowDescription' => '',
                    'imagecols' => '2',
                    'header_layout' => '3',
                    'sectionIndex' => '1',
                    'l18n_diffsource' => '',
                    'tx_flux_column' => '',
                    'tx_flux_parent' => '0',
                    'tx_flux_children' => '0',
                ));

                // Speichert H4-Überschriften mit Text in DB
                $GLOBALS['TYPO3_DB']->exec_INSERTquery('tt_content', array(
                    'pid' => (int)$data['uid'],
                    'bodytext' => $dokument->content[$i][p],
                    'header' => $dokument->content[$i][h4],
                    'CType' => 'textmedia',
                    'rowDescription' => '',
                    'imagecols' => '2',
                    'header_layout' => '4',
                    'sectionIndex' => '1',
                    'l18n_diffsource' => '',
                    'tx_flux_column' => '',
                    'tx_flux_parent' => '0',
                    'tx_flux_children' => '0',
                ));

                // Speichert Tippboxen in DB
                $GLOBALS['TYPO3_DB']->exec_INSERTquery('tt_content', array(
                    'pid' => (int)$data['uid'],
                    'bodytext' => $dokument->content[$i][tippBoxContent],
                    'header' => $dokument->content[$i][tippBoxTitle],
                    'layout' => $dokument->content[$i][layout],
                    'tx_iconfont_icon' => $dokument->content[$i][icon],
                    'header_layout' => '20',
                    'CType' => 'textmedia',
                    'rowDescription' => '',
                    'imagecols' => '2',
                    'sectionIndex' => '1',
                    'l18n_diffsource' => '',
                    'tx_flux_column' => '',
                    'tx_flux_parent' => '0',
                    'tx_flux_children' => '0',
                ));

                // Speichert CodeSnippets in DB
                $GLOBALS['TYPO3_DB']->exec_INSERTquery('tt_content', array(
                    'pid' => (int)$data['uid'],
                    'bodytext' => $dokument->content[$i][codeSnippet],
                    'header' => $dokument->content[$i][noHeaderCodeSnippet],
                    'layout' => '0',
                    'tx_iconfont_icon' => '0',
                    'header_layout' => '0',
                    'CType' => 'fs_code_snippet',
                    'rowDescription' => '',
                    'imagecols' => '2',
                    'sectionIndex' => '1',
                    'l18n_diffsource' => '',
                    'tx_flux_column' => $dokument->content[$i][leer],
                    'tx_flux_parent' => '0',
                    'tx_flux_children' => NULL,
                    'programming_language' => 'mixed',
                    'fe_group' => '',
                    'table_delimiter' => '124'
                ));
                
                // Speichert Inhaltsangabe(toc) in DB
                $GLOBALS['TYPO3_DB']->exec_INSERTquery('tt_content', array(
                    'pid' => (int)$data['uid'],
                    'CType' => 'list',
                    'list_type' => $dokument->content[$i][toc],
                    'rowDescription' => '',
                    'imagecols' => '2',
                    'pages' => '',
                    'fe_group' => '',
                    'sectionIndex' => '1' 
                ));
                
                // Speichert Tabellen in DB
                $GLOBALS['TYPO3_DB']->exec_INSERTquery('tt_content', array(
                    'pid' => (int)$data['uid'],
                    'bodytext' => $dokument->content[$i][table],
                    'header' => $dokument->content[$i][nein],
                    'table_delimiter' => 124,
                    'CType' => 'table',
                    'table_header_position' => '1'
                ));

                // Speichert reinen Text ohne Überschriften in DB
                $GLOBALS['TYPO3_DB']->exec_INSERTquery('tt_content', array(
                    'pid' => (int)$data['uid'],
                    'bodytext' => $dokument->content[$i][p],
                    'header' => $dokument->content[$i][not],
                    'CType' => 'textmedia'
                ));

                // Speichert HTML-Code wie im Dokument in DB
                $GLOBALS['TYPO3_DB']->exec_INSERTquery('tt_content', array(
                    'pid' => (int)$data['uid'],
                    'bodytext' => $dokument->content[$i][htmlbody],
                    'header' => $dokument->content[$i][noheaderhtml],
                    'CType' => 'html'
                ));

                
            }
            //return $dokument;
            return "Upload erfolgreich!";
        } else {
            return "Upload fehlgeschlagen. Artikel schon vorhanden";
              
        }
        
        
    }

     /**
    * @url POST intdokument
    * @status 201
    *
    * @param Dokument $dokument {@type \Iwda\IwdaWord2digi\Domain\Model\Dokument}
    * @return Dokument {@type \Iwda\IwdaWord2digi\Domain\Model\Dokument}
    * @throws RestExeption 400 Dokument is not valid
    */
    public function saveIntDokument(Dokument $dokument)
    {
        
        $GLOBALS['TYPO3_DB']->store_lastBuiltQuery = 1; //Turn on Debug-mode
        
        $GLOBALS['TYPO3_DB']->exec_INSERTquery('pages_language_overlay', array(
            'title' => $dokument->content[0][title], 
            'pid' => $dokument->content[0][artikelID],
            'hidden' => '1', 
            'doktype' => '1',
            'sys_language_uid' => $dokument->content[0][laenderCode],
            'description' => $dokument->content[0][description],
            'abstract' => $dokument->content[0][teaser],
            'tx_seo_titletag' => $dokument->content[0][title]
        ));

        $GLOBALS['TYPO3_DB']->exec_INSERTquery('tt_content', array(
                'pid' => $dokument->content[0][artikelID],
                'cType' => 'list',
                'list_type' => 'rating_rating',
                'sys_language_uid' => $dokument->content[0][laenderCode],
            )); 

        for ($i = 1; $i < count($dokument->content); $i++){

            // Speichert die H1-Überschrift in DB
            $GLOBALS['TYPO3_DB']->exec_INSERTquery('tt_content', array(
                'pid' => $dokument->content[0][artikelID],
                'header' => $dokument->content[$i][h1],
                'sys_language_uid' => $dokument->content[0][laenderCode],
                'CType' => 'header',
                'rowDescription' => '',
                'imagecols' => '2',
                'header_layout' => '1',
                'sectionIndex' => '1',
                'l18n_diffsource' => '',
                'tx_flux_column' => '',
                'tx_flux_parent' => '0',
                'tx_flux_children' => '0',
            ));  

             // Speichert H2-Überschriften mit Text in DB
             $GLOBALS['TYPO3_DB']->exec_INSERTquery('tt_content', array(
                'pid' => $dokument->content[0][artikelID],
                'bodytext' => $dokument->content[$i][p],
                'header' => $dokument->content[$i][h2],
                'sys_language_uid' => $dokument->content[0][laenderCode],
                'CType' => 'textmedia',
                'rowDescription' => '',
                'imagecols' => '2',
                'header_layout' => '0',
                'sectionIndex' => '1',
                'l18n_diffsource' => '',
                'tx_flux_column' => '',
                'tx_flux_parent' => '0',
                'tx_flux_children' => '0',
            ));

            // Speichert H3-Überschriften mit Text in DB
            $GLOBALS['TYPO3_DB']->exec_INSERTquery('tt_content', array(
                'pid' => $dokument->content[0][artikelID],
                'bodytext' => $dokument->content[$i][p],
                'header' => $dokument->content[$i][h3],
                'sys_language_uid' => $dokument->content[0][laenderCode],
                'CType' => 'textmedia',
                'rowDescription' => '',
                'imagecols' => '2',
                'header_layout' => '3',
                'sectionIndex' => '1',
                'l18n_diffsource' => '',
                'tx_flux_column' => '',
                'tx_flux_parent' => '0',
                'tx_flux_children' => '0',
            ));

            // Speichert H4-Überschriften mit Text in DB
            $GLOBALS['TYPO3_DB']->exec_INSERTquery('tt_content', array(
                'pid' => $dokument->content[0][artikelID],
                'bodytext' => $dokument->content[$i][p],
                'header' => $dokument->content[$i][h4],
                'sys_language_uid' => $dokument->content[0][laenderCode],
                'CType' => 'textmedia',
                'rowDescription' => '',
                'imagecols' => '2',
                'header_layout' => '4',
                'sectionIndex' => '1',
                'l18n_diffsource' => '',
                'tx_flux_column' => '',
                'tx_flux_parent' => '0',
                'tx_flux_children' => '0',
            ));

            // Speichert Tippboxen in DB
            $GLOBALS['TYPO3_DB']->exec_INSERTquery('tt_content', array(
                'pid' => $dokument->content[0][artikelID],
                'bodytext' => $dokument->content[$i][tippBoxContent],
                'header' => $dokument->content[$i][tippBoxTitle],
                'layout' => $dokument->content[$i][layout],
                'tx_iconfont_icon' => $dokument->content[$i][icon],
                'sys_language_uid' => $dokument->content[0][laenderCode],
                'header_layout' => '20',
                'CType' => 'textmedia',
                'rowDescription' => '',
                'imagecols' => '2',
                'sectionIndex' => '1',
                'l18n_diffsource' => '',
                'tx_flux_column' => '',
                'tx_flux_parent' => '0',
                'tx_flux_children' => '0',
            ));

            // Speichert CodeSnippets in DB
            $GLOBALS['TYPO3_DB']->exec_INSERTquery('tt_content', array(
                'pid' => $dokument->content[0][artikelID],
                'bodytext' => $dokument->content[$i][codeSnippet],
                'header' => $dokument->content[$i][noHeaderCodeSnippet],
                'sys_language_uid' => $dokument->content[0][laenderCode],
                'layout' => '0',
                'tx_iconfont_icon' => '0',
                'header_layout' => '0',
                'CType' => 'fs_code_snippet',
                'rowDescription' => '',
                'imagecols' => '2',
                'sectionIndex' => '1',
                'l18n_diffsource' => '',
                'tx_flux_column' => $dokument->content[$i][leer],
                'tx_flux_parent' => '0',
                'tx_flux_children' => NULL,
                'programming_language' => 'mixed',
                'fe_group' => '',
                'table_delimiter' => '124'
            ));

            // Speichert Inhaltsangabe(toc) in DB
            $GLOBALS['TYPO3_DB']->exec_INSERTquery('tt_content', array(
                'pid' => $dokument->content[0][artikelID],
                'CType' => 'list',
                'list_type' => $dokument->content[$i][toc],
                'sys_language_uid' => $dokument->content[0][laenderCode],
                'rowDescription' => '',
                'imagecols' => '2',
                'pages' => '',
                'fe_group' => '',
                'sectionIndex' => '1'

            ));
            
            // Speichert Tabellen in DB
            $GLOBALS['TYPO3_DB']->exec_INSERTquery('tt_content', array(
                'pid' => $dokument->content[0][artikelID],
                'bodytext' => $dokument->content[$i][table],
                'header' => $dokument->content[$i][nein],
                'sys_language_uid' => $dokument->content[0][laenderCode],
                'table_delimiter' => 124,
                'CType' => 'table',
                'table_header_position' => '1'
            ));

            // Speichert reinen Text ohne Überschriften in DB
            $GLOBALS['TYPO3_DB']->exec_INSERTquery('tt_content', array(
                'pid' => $dokument->content[0][artikelID],
                'bodytext' => $dokument->content[$i][p],
                'sys_language_uid' => $dokument->content[0][laenderCode],
                'header' => $dokument->content[$i][not],
                'CType' => 'textmedia'
            ));

            // Speichert HTML-Code wie im Dokument in DB
            $GLOBALS['TYPO3_DB']->exec_INSERTquery('tt_content', array(
                'pid' => $dokument->content[0][artikelID],
                'bodytext' => $dokument->content[$i][htmlbody],
                'header' => $dokument->content[$i][noheaderhtml],
                'sys_language_uid' => $dokument->content[0][laenderCode],
                'CType' => 'html'
            ));

           
        }
        return $dokument;
    }


     /**
    * @url GET get_all_kategorien
    * @status 201
    *
    */
    public function getDocuments(){
        /*

        SELECT t.* FROM pages t 
        LEFT JOIN pages s ON (t.pid = s.uid)
        WHERE s.pid = 1
        AND t.deleted = 0
        AND s.deleted = 0
        AND s.cruser_id = 3 ORDER BY `uid`  DESC 

       */

        $uidsFirst=[];
        $uidsSecond=[];
        $uidsThird=[];

        $resFirst = $GLOBALS['TYPO3_DB']->exec_SELECTquery('uid, title', 'pages', 'uid=1','','','');
        while ($rowFirst = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($resFirst)) {
            array_push($uidsFirst, $rowFirst);
        }

        $resSecond = $GLOBALS['TYPO3_DB']->exec_SELECTquery('uid, title', 'pages', 'pid="'.$uidsFirst[0][uid].'" AND cruser_id=3 AND deleted=0' ,'','','');
        while ($rowSecond = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($resSecond)) {
            array_push($uidsSecond, $rowSecond);
        }
        


        for ($i = 0; $i < count($uidsSecond); $i++){
            $resThird = $GLOBALS['TYPO3_DB']->exec_SELECTquery('uid, title', 'pages', 'pid="'.$uidsSecond[$i][uid].'" AND deleted=0' ,'','','');
            while ($rowThird = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($resThird)) {
                array_push($uidsThird, $rowThird);
            }
        }
        return $uidsThird;
        //return $row;
    }

     /**
    * @url GET get_all_ger_article
    * @status 201
    *
    */
    public function getAllGerArticle(){
       
        
       

        $uidsFirst=[];
        $uidsSecond=[];
        $uidsThird=[];
        $uidsFourth=[];

        $resFirst = $GLOBALS['TYPO3_DB']->exec_SELECTquery('uid, title', 'pages', 'uid=1','','','');
        while ($rowFirst = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($resFirst)) {
            array_push($uidsFirst, $rowFirst);
        }

        $resSecond = $GLOBALS['TYPO3_DB']->exec_SELECTquery('uid, title', 'pages', 'pid="'.$uidsFirst[0][uid].'" AND cruser_id=3 AND deleted=0' ,'','','');
        while ($rowSecond = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($resSecond)) {
            array_push($uidsSecond, $rowSecond);
        }
        


        for ($i = 0; $i < count($uidsSecond); $i++){
            $resThird = $GLOBALS['TYPO3_DB']->exec_SELECTquery('uid, title', 'pages', 'pid="'.$uidsSecond[$i][uid].'" AND deleted=0' ,'','','');
            while ($rowThird = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($resThird)) {
                array_push($uidsThird, $rowThird);
            }
        }

        for ($i = 0; $i < count($uidsThird); $i++){
            $resFourth = $GLOBALS['TYPO3_DB']->exec_SELECTquery('uid, title', 'pages', 'pid="'.$uidsThird[$i][uid].'" AND deleted=0' ,'','','');
            while ($rowFourth = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($resFourth)) {
                array_push($uidsFourth, $rowFourth);
            }
        }
        return $uidsFourth;

    }

}