<?php



namespace App\Mail;



use Illuminate\Bus\Queueable;

use Illuminate\Mail\Mailable;

use Illuminate\Queue\SerializesModels;

use Illuminate\Contracts\Queue\ShouldQueue;




class MailRelanceTraitementCourrier extends Mailable

{

    use Queueable, SerializesModels;



    

    /**

     * Create a new message instance.

     *

     * @return void

     */

  


    public $nombreCourrierattente;
    public $lienC;
    public $nameC;

   

   

    public function __construct($nbrecourrier,$lien,$name)

    {
       
       $this->nombreCourrierattente=$nbrecourrier;
        $this->lienC=$lien;
         $this->nameC=$name;

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
        $e_name=$this->nameC;

       

        
      

       return $this->subject('Rélance de traitement du Courrier GEC')->bcc('kadiatou.sall@apip.gov.gn')->view('Emailcourriers/relanceTraimentCourrier')->with([
            'nbrecourrier'=> $this->nombreCourrierattente,
           'lien'=>$this->lienC,
           'name'=>$this->nameC


         ]);

    }

}

