<?php



namespace App\Mail;



use Illuminate\Bus\Queueable;

use Illuminate\Mail\Mailable;

use Illuminate\Queue\SerializesModels;

use Illuminate\Contracts\Queue\ShouldQueue;




class MailEnregistrementRendezVous extends Mailable

{

    use Queueable, SerializesModels;



    

    /**

     * Create a new message instance.

     *

     * @return void

     */

  

    public $titreR;
    public $type_rendez_vousR;
    public $prioriteR;
    public $motifR;
    public $date_rendez_vousR;
    public $nomR;
    public $numeroR;
    public $lieuR;
   

   

    public function __construct($titre, $motif, $date_rendez_vous,$nom,$numero,$lieu)

    {
       $this->titreR=$titre;
       $this->motifR=$motif;
       $this->date_rendez_vousR=$date_rendez_vous;
       $this->nomR=$nom;
       $this->numeroR=$numero;
       $this->lieuR=$lieu;
       
    }



    /**

     * Build the message.

     *

     * @return $this

     */

    public function build()

    {

       $e_titre=$this->titreR;
       $e_motif=$this->motifR;
       $e_date_rendez_vous=$this->date_rendez_vousR;
       $e_nom=$this->nomR;
       $e_numero=$this->numeroR;
      $e_lieu=$this->lieuR;


       return $this->subject('Confirmation de rendez-vous')->cc('kadiatou.sall@apip.gov.gn')->view('visiteurs/emailEnregistrementVisiteur')->with(['titre'=>$this->titreR,'motif'=> $this->motifR,

           'date_rendez_vous'=> $this->date_rendez_vousR,

           'nom'=> $this->nomR,

            'numero'=> $this->numeroR,
            'lieu'=> $this->lieuR
           

         ]);

    }

}

