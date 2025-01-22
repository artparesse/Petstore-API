<?php

namespace App\Exceptions;

use Exception;

class PetstoreException extends Exception
{
    public function render( $request ) {
        return redirect()
            ->back()
            ->withErrors(['error' => $this->message]);
    }
}
