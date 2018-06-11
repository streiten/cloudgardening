<?php


class Typer extends Eloquent {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'typers';

	protected $fillable = ['typer','uid'];

	/**
     * String from which the shortener code will be generated
     */ 
    protected $shuffleData = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

	 /**
     * Checks if the URL exists or not
     * 
     * @param string $slug URL that is to be checked for existence in database
     * @return boolean true if the shortcode is found and false otherwise
     */ 
    public function codeExists( $slug )
    {
        return $this->where('slug', '=', $slug)->count() !== 0;
    }

     /**
     * Generates a unique slug
     * @return string 6 characters unique shortcode
     */ 
    public function generateShortCode()
    {
        $slug = '';
        // Keep generating a shortcode unless a unique one is found
        do {
            
            $shuffled = str_shuffle( $this->shuffleData );
            $slug = substr($shuffled, 0, 3);
        } while ( $this->codeExists( $slug ) );
        
        $this->slug = $slug;

        return $slug;
    }

    /**
     * Gets the long URL associated with the passed shortcode
     * 
     * @param string $shortCode Shortcode whose associated long URL is required
     * @return object The Typer associated with the short code or "falsy" value otherwise
     */ 
    public function getTyperByURL( $slug )
    {
        return $this->where('slug', $slug)->first();
    }

}
