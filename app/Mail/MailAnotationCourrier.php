<?php



namespace App\Mail;



use Illuminate\Bus\Queueable;

use Illuminate\Mail\Mailable;

use Illuminate\Queue\SerializesModels;

use Illuminate\Contracts\Queue\ShouldQueue;




class MailAnotationCourrier extends Mailable

{

    use Queueable, SerializesModels;



    

    /**

     * Create a new message instance.

     *

     * @return void

     */

  

    public $nomC;
    public $commentaireC;
    public $objetC;
    public $referenceC;
    public $destinataireC;
    public $file_pathC;
    public $typeCourrierC;
    public $lienC;

   

   

    public function __construct($nom,$commentaire,$objet, $reference, $destinataire,$typeCourrier,$file_path,$lien)

    {
       $this->nomC=$nom;
       $this->commentaireC=$commentaire;
       $this->objetC=$objet;
       $this->referenceC=$reference;
       $this->destinataireC=$destinataire;
       $this->file_pathC=$file_path;
       $this->typeCourrierC=$typeCourrier;
        $this->lienC=$lien;

    }



    /**

     * Build the message.

     *

     * @return $this

     */

    public function build()

    {

       $e_nom=$this->nomC;
       $e_commentaire=$this->commentaireC;
       $e_objet=$this->objetC;
       $e_reference=$this->referenceC;
       $e_destinataire=$this->destinataireC;
       $e_file_path=$this->file_pathC;
       $e_typeCourrier=$this->typeCourrierC;
       $e_lien=$this->lienC;

       

        
      

       return $this->subject('Annotation d\' un Nouveau Courrier GEC')->cc('kadiatou.sall@apip.gov.gn')->view('Emailcourriers/anotationCourrier')->with([
        'nom'=>$this->nomC,
        'commentaire'=>$this->commentaireC,
        'objet'=>$this->objetC,'reference'=> $this->referenceC,

           'destinataire'=> $this->destinataireC,

           'typeCourrier'=> $this->typeCourrierC,

            'file_path'=> $this->file_pathC,

           'lien'=>$this->lienC


         ]);

    }

}

