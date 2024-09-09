 <?php
           defined('BASEPATH') OR exit('No direct script access allowed');
        
           class Compiler extends CI_Controller {
        
               public function index() {
                $data['logo_path'] = base_url('assets/logo.png');
                   $this->load->view('compiler_view',$data);
               }
        
               public function execute_code() {
                   // JDoodle API Credentials
                   $client_id = "63746d67aa1279b4670262e4727b65d9";
                   $client_secret = "69bf234c7af0de78977e7585d081aa969c5107692f4840ad2f148b18366ce2ac";
        
                   // Get the code and language from the POST request
                   $code = $this->input->post('code');
                   $language = $this->input->post('language');
                   //$version_index = "0"; // You can modify this based on the language version needed
                   if ($language == "python3") {
                    $version_index = "5"; // Version index 5 for Python 3
                   } elseif ($language == "python2") {
                    $version_index = "3"; // Version index 3 for Python 2
                   } else {
                    $version_index = "0"; // Default version index for other languages
                   }
                
                
        
                   if (empty($code) || empty($language)) {
                       echo "Code or language not provided.";
                       return;
                   }

                   // API endpoint
                   $url = "https://api.jdoodle.com/v1/execute";
        
                   // Prepare the data for the POST request
                   $data = array(
                       "script" => $code,
                       "language" => $language,
                       "versionIndex" => $version_index,
                       "clientId" => $client_id,
                       "clientSecret" => $client_secret
                   );
        
                   // Initialize cURL
                   $ch = curl_init($url);
                   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                   curl_setopt($ch, CURLOPT_POST, true);
                   curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                   curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        
                   // Execute the request
                   $response = curl_exec($ch);
                   curl_close($ch);
        
                   // Handle the response
                   if ($response === FALSE) {
                       die('Error: ' . curl_error($ch));
                   }
        
                   // echo $response;
                // Decode the JSON response
                 $result = json_decode($response, true);
        
                  // Display the output
                  if (isset($result['output'])) {
                      echo "<h2>Output:</h2><pre>" . htmlspecialchars($result['output']) . "</pre>";
                    } 
                    else {
                       echo "<h2>Error:</h2><pre>" . htmlspecialchars($result['error']) . "</pre>";
                    }
               }
           }

