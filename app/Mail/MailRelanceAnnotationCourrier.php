<?php



namespace App\Mail;



use Illuminate\Bus\Queueable;

use Illuminate\Mail\Mailable;

use Illuminate\Queue\SerializesModels;

use Illuminate\Contracts\Queue\ShouldQueue;




class MailRelanceAnnotationCourrier extends Mailable

{

    use Queueable, SerializesModels;



    

    /**

     * Create a new message instance.

     *

     * @return void

     */

  


    public $nombreCourrierattente;
    public $lienC;
    public $posteC;

   

   

    public function __construct($nbrecourrier,$lien,$post)

    {
       
       $this->nombreCourrierattente=$nbrecourrier;
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

    
       $e_nbreCourrier=$this->nombreCourrierattente;
       $e_lien=$this->lienC;
        $e_post=$this->postC;

       

        
      

       return $this->subject('Rélance d\' annotation du Courrier GEC')->bcc('kadiatou.sall@apip.gov.gn')->view('Emailcourriers/relanceAnnotationCourrier')->with([
            'nbrecourrier'=> $this->nombreCourrierattente,
           'lien'=>$this->lienC,
           'post'=>$this->postC


         ]);

    }

}

