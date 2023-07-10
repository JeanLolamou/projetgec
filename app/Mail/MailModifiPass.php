<?php



namespace App\Mail;



use Illuminate\Bus\Queueable;

use Illuminate\Mail\Mailable;

use Illuminate\Queue\SerializesModels;

use Illuminate\Contracts\Queue\ShouldQueue;




class MailModifiPass extends Mailable

{

    use Queueable, SerializesModels;



    

    /**

     * Create a new message instance.

     *

     * @return void

     */

  

    public $nomC;
  
    public $lienC;

   

   

    public function __construct($nom,$lien)

    {
       $this->nomC=$nom;
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
       $e_lien=$this->lienC;

       return $this->subject('Modification du Mot de passe GEC')->cc('kadiatou.sall@apip.gov.gn')->view('Emailcourriers/modifiPass')->with([
        'nom'=>$this->nomC,
       'lien'=>$this->lienC


         ]);

    }

}

