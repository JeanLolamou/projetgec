<?php



namespace App\Mail;



use Illuminate\Bus\Queueable;

use Illuminate\Mail\Mailable;

use Illuminate\Queue\SerializesModels;

use Illuminate\Contracts\Queue\ShouldQueue;




class MailReponseCourrierDestinateur extends Mailable

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
   

   

   

    public function __construct($objet, $reference, $destinataire,$file_path)

    {
       $this->objetC=$objet;
       $this->referenceC=$reference;
       $this->destinataireC=$destinataire;
       $this->file_pathC=$file_path;
       

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
      

       

        
      

       return $this->subject('Réponse du Courrier Adréssé à l\'APIP')->cc('kadiatou.sall@apip.gov.gn')->view('Emailcourriers/reponseCourrierDestinateur')->attach(public_path('/documents/Traités/'.$this->file_pathC), [
                         'as' =>$this->file_pathC,
                         'mime' => 'application/pdf',
                    ])->with(['objet'=>$this->objetC,'reference'=> $this->referenceC,

           'destinataire'=> $this->destinataireC,
         
            'file_path'=> $this->file_pathC
          


         ]);

    }

}

 