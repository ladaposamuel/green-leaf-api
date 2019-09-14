<?php

function respond($code =200, $status, $data ){
  return response()->json([
    'status' => $status,
    'data' => $data
  ],$code);
}
