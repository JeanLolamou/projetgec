<?php



namespace App\Mail;



use Illuminate\Bus\Queueable;

use Illuminate\Mail\Mailable;

use Illuminate\Queue\SerializesModels;

use Illuminate\Contracts\Queue\ShouldQueue;




class MailEnregistrementCourrierDepart extends Mailable

{

    use Queueable, SerializesModels;



    

    /**

     * Create a new message instance.

     *

     * @return void

     */

  

    public $objetC;
    public $referenceC;
    public $destinataireC;
    public $file_pathC;
    public $typeCourrierC;
    public $lienC;
    public $posteC;
    public $categorieC;

   

   

    public function __construct($objet, $reference, $destinataire,$typeCourrier,$file_path,$lien,$post,$categorie)

    {
       $this->objetC=$objet;
       $this->referenceC=$reference;
       $this->destinataireC=$destinataire;
       $this->file_pathC=$file_path;
       $this->typeCourrierC=$typeCourrier;
        $this->lienC=$lien;
         $this->postC=$post;
  $this->categorieC=$categorie;

    }



    /**

     * Build the message.

     *

     * @return $this

     */

    public function build()

    {

       $e_objet=$this->objetC;
       $e_reference=$this->referenceC;
       $e_destinataire=$this->destinataireC;
       $e_file_path=$this->file_pathC;
       $e_typeCourrier=$this->typeCourrierC;
       $e_lieno=$this->lienC;
        $e_post=$this->postC;
      $e_categorie=$this->categorieC;

       

        
      

       return $this->subject('Transmission du Courrier GEC')->cc('kadiatou.sall@apip.gov.gn')->view('Emailcourriers/ajoutCourrierDepart')->with(['objet'=>$this->objetC,'reference'=> $this->referenceC,

           'destinataire'=> $this->destinataireC,

           'typeCourrier'=> $this->typeCourrierC,

            'file_path'=> $this->file_pathC,
           'lien'=>$this->lienC,
           'post'=>$this->postC,
           'categorie'=>$this->categorieC


         ]);

    }

}

