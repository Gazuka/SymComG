<?php

namespace App\Twig;

use Twig\TwigFilter;
use App\Twig\GlobalExtension;
use Twig\Extension\AbstractExtension;

class LienBoutonExtension extends GlobalExtension
{    
    public function getFilters()
    {
        return [
            new TwigFilter('BoutonLienSupprimer', [$this, 'afficherBoutonLienSupprimer'], ['is_safe' => ['html', 'twig']]),
            new TwigFilter('BoutonLienSupprimerMini', [$this, 'afficherBoutonLienSupprimerMini'], ['is_safe' => ['html', 'twig']]),
            new TwigFilter('BoutonLienEditer', [$this, 'afficherBoutonLienEditer'], ['is_safe' => ['html', 'twig']]),
            new TwigFilter('BoutonLienEditerMini', [$this, 'afficherBoutonLienEditerMini'], ['is_safe' => ['html', 'twig']]),
            new TwigFilter('BoutonLienSimple', [$this, 'afficherBoutonLien'], ['is_safe' => ['html', 'twig']]),
            new TwigFilter('BoutonValiderFormulaire', [$this, 'afficherBoutonValiderFormulaire'], ['is_safe' => ['html', 'twig']]),
            new TwigFilter('BoutonSimple', [$this, 'afficherBouton'], ['is_safe' => ['html', 'twig']])
            // new TwigFilter('LienBouton', [$this, 'afficheLienBouton'], ['is_safe' => ['html', 'twig']]),
            // new TwigFilter('ModifierBouton', [$this, 'afficheModifierBouton'], ['is_safe' => ['html', 'twig']]),
            // new TwigFilter('ModifierBoutonRond', [$this, 'ModifierBoutonRond'], ['is_safe' => ['html', 'twig']]),
            // new TwigFilter('SupprimerBouton', [$this, 'afficheSupprimerBouton'], ['is_safe' => ['html', 'twig']]),
            // new TwigFilter('BtnSubmit', [$this, 'afficheBtnSubmit'], ['is_safe' => ['html', 'twig']]),
            // new TwigFilter('LienBtnWithIcon', [$this, 'LienbtnWithIcon'], ['is_safe' => ['html', 'twig']]),
            // new TwigFilter('BtnSubmitWithIcon', [$this, 'btnSubmitWithIcon'], ['is_safe' => ['html', 'twig']]),
            // new TwigFilter('LienBtnRond', [$this, 'LienbtnRond'], ['is_safe' => ['html', 'twig']]),
            // new TwigFilter('LienPetitBtnRond', [$this, 'LienpetitBtnRond'], ['is_safe' => ['html', 'twig']])
        ];
    }

    /** Affiche un bouton de suppression avec un modal avant de rediriger vers la page de suppression
     *
     * @param [string] $url //L'url de la page de suppression
     * @param string $text //Texte à ajouter (nom de l'objet à supprimer)
     * @return void
     */
    public function afficherBoutonLienSupprimer($url, $text = '')
    {
        if($text != '')
        {
            $text = ' : '.$text;
        }
        $idUnique = rand(0, 500000);
        $html = "";
        $html .= "<div class='col-12'><button type='button' class='col-12 my-1 btn btn-danger text-capitalize' data-toggle='modal' data-target='#modal_".$idUnique."'>";
        $html .= "<i class='fas fa-trash'></i> ".$this->trad('twig.bouton.supprimer').$text."</a>";
        $html .= "</button>";
        $html .= "<div class='modal fade' id='modal_".$idUnique."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>";
        $html .= " <div class='modal-dialog' role='document'>";
        $html .= "  <div class='modal-content'>";
        $html .= "   <div class='modal-header'>";
        $html .= "    <h5 class='modal-title text-capitalize' id='exampleModalLabel'>".$this->trad('twig.bouton.supprimer.alerte')."</h5>";
        $html .= "    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
        $html .= "     <span aria-hidden='true'>&times;</span>";
        $html .= "    </button>";
        $html .= "   </div>";
        $html .= "   <div class='modal-body'>";
        $html .= "    ".$this->trad('twig.bouton.supprimer.alerte.finale').$text." ?";
        $html .= "   </div>";
        $html .= "   <div class='modal-footer'>";
        $html .= "    <button type='button' class='btn btn-primary' data-dismiss='modal'>Annuler</button>";
        $html .= "    <a class='btn btn-danger text-capitalize' href='".$url."'><i class='fas fa-trash'></i> ".$this->trad('twig.bouton.supprimer').$text."</a>";
        $html .= "   </div>";
        $html .= "  </div>";
        $html .= " </div>";
        $html .= "</div></div>";
        return $html;
    }

    /** Affiche un bouton de suppression avec un modal avant de rediriger vers la page de suppression
     *
     * @param [string] $url //L'url de la page de suppression
     * @param string $text //Texte à ajouter (nom de l'objet à supprimer)
     * @return void
     */
    public function afficherBoutonLienSupprimerMini($url, $text = '')
    {
        if($text != '')
        {
            $text = ' : '.$text;
        }
        $idUnique = rand(0, 500000);
        $html = "";
        $html .= "<button type='button' class='btn-circle btn btn-danger text-capitalize' data-toggle='modal' data-target='#modal_".$idUnique."'>";
        $html .= "<i class='fas fa-trash'></i>";
        $html .= "</button>";
        $html .= "<div class='modal fade' id='modal_".$idUnique."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>";
        $html .= " <div class='modal-dialog' role='document'>";
        $html .= "  <div class='modal-content'>";
        $html .= "   <div class='modal-header'>";
        $html .= "    <h5 class='modal-title text-capitalize' id='exampleModalLabel'>".$this->trad('twig.bouton.supprimer.alerte')."</h5>";
        $html .= "    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
        $html .= "     <span aria-hidden='true'>&times;</span>";
        $html .= "    </button>";
        $html .= "   </div>";
        $html .= "   <div class='modal-body'>";
        $html .= "    ".$this->trad('twig.bouton.supprimer.alerte.finale').$text;
        $html .= "   </div>";
        $html .= "   <div class='modal-footer'>";
        $html .= "    <button type='button' class='btn btn-primary' data-dismiss='modal'>Annuler</button>";
        $html .= "    <a class='btn btn-danger text-capitalize' href='".$url."'><i class='fas fa-trash'></i> ".$this->trad('twig.bouton.supprimer').$text."</a>";
        $html .= "   </div>";
        $html .= "  </div>";
        $html .= " </div>";
        $html .= "</div>";
        return $html;
    }

    public function afficherBoutonLienEditer($url)
    {
        $html = "<div class='col-12'><a class='col-12 my-1 btn btn-primary text-capitalize' href='".$url."'><i class='fas fa-edit'></i> ".$this->trad('twig.bouton.editer')."</a></div>";
        return $html;
    }

    public function afficherBoutonLienEditerMini($url)
    {
        $html = "<a class='btn btn-primary btn-circle' href='".$url."'><i class='fas fa-edit'></i></a>";
        return $html;
    }

    public function afficherBoutonLien($url, $texte, $icon = 'fa-check', $couleur = 'primary')
    {
        $html = "<div class='col-12'><a class='col-12 my-1 btn btn-".$couleur."' href='".$url."'><i class='fas ".$icon."'></i> ".$texte."</a></div>";
        return $html;
    }

    /** Affiche un beau bouton avec une icone et du texte */
    public function afficherBoutonValiderFormulaire($texte, $icon = 'fa-check', $couleur = 'success')
    {
        return "<button type='submit' class='btn btn-".$couleur." col-12'><i class='fas ".$icon."'></i> ".$texte."</button>";
    }

    /** Affiche un beau bouton avec une icone et du texte */
    public function afficherBouton($texte, $icon = 'fa-check', $couleur = 'primary')
    {
        return "<button type='button' class='btn btn-".$couleur." col-12'><i class='fas ".$icon."'></i> ".$texte."</button>";
    }

    // public function afficheLienBouton($lien)
    // {
    //     //On cherche la bonne couleur
    //     if($lien->getColorBoot() != null)
    //     {
    //         $couleur = $lien->getColorBoot();
    //     }
    //     else
    //     {
    //         $couleur = 'primary';
    //     }
    //     //On cherche le logo
    //     if($lien->getFontAwesome() != null)
    //     {
    //         $logo = "<i class='".$lien->getFontAwesome()."'></i>";
    //     }
    //     else
    //     {
    //         $logo = '';
    //     }
    //     //On cherche le label
    //     $label = $lien->getLabel();
    //     //On cherche l'url
    //     if($lien->getPage() != null)
    //     {
    //         $url = $lien->getPage()->getUrl();
    //     }
    //     else
    //     {
    //         if($label->getUrl() != null)
    //         {
    //             $url = $lien->getUrl();
    //         }  
    //         else
    //         {
    //             $url = "#";
    //         }
    //     }

    //     $html = "<a class='btn btn-%s' href='%s'>%s %s</a>";
        
    //     return \sprintf($html, $couleur, $url, $logo, $label);
    // }

    // public function afficheModifierBouton($url)
    // {
    //     $html = "<a class='btn btn-primary' href='".$url."'><i class='fas fa-edit'></i> Modifier</a>";
    //     return $html;
    // }

    // public function ModifierBoutonRond($url)
    // {
    //     $html = "<a href='".$url."' class='btn btn-primary btn-circle'><i class='fas fa-edit'></i></a>";
    //     return $html;
    // }

    // /** Affiche un bouton de suppression avec un modal avant de rediriger vers la page de suppression
    //  *
    //  * @param [string] $url //L'url de la page de suppression
    //  * @param string $text //Texte à ajouter (nom de l'objet à supprimer)
    //  * @return void
    //  */
    // public function afficheSupprimerBouton($url, $text = '')
    // {
    //     if($text != '')
    //     {
    //         $text = ': '.$text;
    //     }
    //     $idUnique = rand(0, 500000);
    //     $html = "";
    //     $html .= "<button type='button' class='btn btn-danger' data-toggle='modal' data-target='#modal_".$idUnique."'>";
    //     $html .= "<i class='fas fa-trash'></i> Supprimer ".$text."</a>";
    //     $html .= "</button>";
    //     $html .= "<div class='modal fade' id='modal_".$idUnique."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>";
    //     $html .= " <div class='modal-dialog' role='document'>";
    //     $html .= "  <div class='modal-content'>";
    //     $html .= "   <div class='modal-header'>";
    //     $html .= "    <h5 class='modal-title' id='exampleModalLabel'>Attention, suppression définitive !</h5>";
    //     $html .= "    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
    //     $html .= "     <span aria-hidden='true'>&times;</span>";
    //     $html .= "    </button>";
    //     $html .= "   </div>";
    //     $html .= "   <div class='modal-body'>";
    //     $html .= "    Dernière chance, êtes-vous bien certain de vouloir supprimer ".$text." ?";
    //     $html .= "   </div>";
    //     $html .= "   <div class='modal-footer'>";
    //     $html .= "    <button type='button' class='btn btn-primary' data-dismiss='modal'>Annuler</button>";
    //     $html .= "    <a class='btn btn-danger' href='".$url."'><i class='fas fa-trash'></i> Supprimer ".$text."</a>";
    //     $html .= "   </div>";
    //     $html .= "  </div>";
    //     $html .= " </div>";
    //     $html .= "</div>";
    //     return $html;
    // }

    // public function afficheBtnSubmit($text)
    // {
    //     return "<button type='submit' class='btn btn-success'><i class='fas fa-check'></i> ".$text."</button>";
    // }

    // /** Affiche un beau bouton avec une icone et du texte */
    // public function LienbtnWithIcon($url, $texte, $icon, $couleur)
    // {
    //     if($couleur != 'danger')
    //     {
    //         $html = '<a href="'.$url.'" class="btn btn-'.$couleur.' btn-icon-split">
    //                 <span class="icon text-white-50">';
                        
    //                 if(is_array($icon))
    //                 {
    //                     foreach($icon as $i)
    //                     {
    //                         $html .= '<i class="fas '.$i.'"></i> ';    
    //                     }
    //                 }
    //                 else
    //                 {
    //                     $html .= '<i class="fas '.$icon.'"></i> ';
    //                 }
    //     $html .=    '</span>
    //                 <span class="text">
    //                     '.$texte.'
    //                 </span>
    //             </a>';
    //     return $html;
    //     }
    //     else
    //     {
    //         return $this->dangerLienBtn('btn btn-'.$couleur.' btn-icon-split', $texte, $url);
    //     }        
    // }

    // /** Affiche un beau bouton avec une icone et du texte */
    // public function btnSubmitWithIcon($texte, $icon, $couleur)
    // {
    //     return "<button type='submit' id='toto' class='btn btn-".$couleur." col-12'><i class='fas ".$icon."'></i> ".$texte."</button>";
    // }

    // /** Affiche un bouton rond avec une icone */
    // public function LienbtnRond($url, $texte, $icon, $couleur)
    // {
    //     if($couleur != 'danger')
    //     {
    //         $html = "<a href='".$url."' class='btn btn-".$couleur." btn-circle' data-toggle='tooltip' data-placement='top' title='".$texte."'><i class='fas ".$icon."'></i></a>";
    //         return $html;
    //     }
    //     else
    //     {
    //         return $this->dangerLienBtn('btn btn-'.$couleur.' btn-circle', null, $url, $texte);
    //     }
    // }

    // /** Affiche un bouton rond avec une icone */
    // public function LienpetitBtnRond($url, $texte, $icon, $couleur)
    // {
    //     if($couleur != 'danger')
    //     {
    //         $html = "<a href='".$url."' class='btn btn-".$couleur." btn-circle btn-sm' data-toggle='tooltip' data-placement='top' title='".$texte."'><i class='fas ".$icon."'></i></a>";
    //         return $html;
    //     }
    //     else
    //     {
    //         return $this->dangerLienBtn('btn btn-'.$couleur.' btn-circle btn-sm', null, $url, $texte);
    //     }
    // }

    // private function dangerLienBtn($class, $texte, $url, $tooltip = null)
    // {
    //     $idUnique = rand(0, 500000);
    //     $html = "";
    //     if($texte != null)
    //     {
    //         $html .= "<button type='button' class='".$class."' data-toggle='modal' data-target='#modal_".$idUnique."'>";
    //         $html .= "<span class='icon text-white-50'><i class='fas fa-trash'></i></span>";
    //         $html .= "<span class='text'>";
    //         $html .= $texte;
    //         $html .= "</span>";
    //     }
    //     else
    //     {
    //         $html .= "<button type='button' class='".$class."' data-toggle='modal' data-target='#modal_".$idUnique."'>";
    //         $html .= "<i class='fas fa-trash'></i> ";
    //     }        
    //     $html .= "</button>";
    //     $html .= "<div class='modal fade' id='modal_".$idUnique."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>";
    //     $html .= " <div class='modal-dialog' role='document'>";
    //     $html .= "  <div class='modal-content'>";
    //     $html .= "   <div class='modal-header'>";
    //     $html .= "    <h5 class='modal-title' id='exampleModalLabel'>Attention, suppression définitive !</h5>";
    //     $html .= "    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
    //     $html .= "     <span aria-hidden='true'>&times;</span>";
    //     $html .= "    </button>";
    //     $html .= "   </div>";
    //     $html .= "   <div class='modal-body'>";
    //     $html .= "    Dernière chance, êtes-vous bien certain de vouloir supprimer ceci ?";
    //     $html .= "   </div>";
    //     $html .= "   <div class='modal-footer'>";
    //     $html .= "    <button type='button' class='btn btn-primary btn-icon-split' data-dismiss='modal'><span class='icon text-white-50'><i class='fas fa-arrow-alt-circle-left'></i></span><span class='text'>Annuler</span></button>";
    //     $html .= "    <a class='btn btn-danger btn-icon-split' href='".$url."'><span class='icon text-white-50'><i class='fas fa-trash'></i></span><span class='text'>Supprimer</span></a>";
    //     $html .= "   </div>";
    //     $html .= "  </div>";
    //     $html .= " </div>";
    //     $html .= "</div>";
    //     return $html;
    // }
}