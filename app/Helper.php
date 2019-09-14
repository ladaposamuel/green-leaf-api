<?php

function respond($status, $data, $code = 200)
{
   return response()->json([
      'status' => $status,
      $status === 'success' ? 'data' : 'error' => $data
   ],$code);
}
