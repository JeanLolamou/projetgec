<?php



namespace App\Mail;



use Illuminate\Bus\Queueable;

use Illuminate\Mail\Mailable;

use Illuminate\Queue\SerializesModels;

use Illuminate\Contracts\Queue\ShouldQueue;




class MailEnregistrementCourrierDestinateur extends Mailable

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
    public $numeroC;
    public $posteC;

   

   

    public function __construct($objet, $reference, $destinataire,$typeCourrier,$file_path,$numero,$post)

    {
       $this->objetC=$objet;
       $this->referenceC=$reference;
       $this->destinataireC=$destinataire;
       $this->file_pathC=$file_path;
       $this->typeCourrierC=$typeCourrier;
        $this->numeroC=$numero;
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
       $e_numero=$this->numeroC;
        $e_post=$this->postC;

       

        
      

       return $this->subject('Réception d\' un Nouveau Courrier GEC')->cc('kadiatou.sall@apip.gov.gn')->view('Emailcourriers/ajoutCourrierDestinateur')->with(['objet'=>$this->objetC,'reference'=> $this->referenceC,

           'destinataire'=> $this->destinataireC,

           'typeCourrier'=> $this->typeCourrierC,

            'file_path'=> $this->file_pathC,
           'numero'=>$this->numeroC,
           'post'=>$this->postC


         ]);

    }

}

