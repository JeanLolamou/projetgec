<?php



namespace App\Mail;



use Illuminate\Bus\Queueable;

use Illuminate\Mail\Mailable;

use Illuminate\Queue\SerializesModels;

use Illuminate\Contracts\Queue\ShouldQueue;




class MailDechargerCourrier extends Mailable

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

   

   

    public function __construct($objet, $reference, $destinataire,$typeCourrier,$file_path,$lien,$post)

    {
       $this->objetC=$objet;
       $this->referenceC=$reference;
       $this->destinataireC=$destinataire;
       $this->file_pathC=$file_path;
       $this->typeCourrierC=$typeCourrier;
        $this->lienC=$lien;
         $this->postC=$post;

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
       $e_lien=$this->lienC;
        $e_post=$this->postC;

       

        
      

       return $this->subject('Réception d\' un Nouveau Courrier GEC')->cc('kadiatou.sall@apip.gov.gn')->view('Emailcourriers/ajoutDechargeCourrier')->with(['objet'=>$this->objetC,'reference'=> $this->referenceC,

           'destinataire'=> $this->destinataireC,

           'typeCourrier'=> $this->typeCourrierC,

            'file_path'=> $this->file_pathC,
           'lien'=>$this->lienC,
           'post'=>$this->postC


         ]);

    }

}

