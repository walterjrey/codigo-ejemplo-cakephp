<?php
App::uses('Sanitize', 'Utility');
class AdminController extends AppController {
   
    function beforeFilter() {
		parent::beforeFilter();
        $user_data = $this->Session->read('UserData');
        if(empty($user_data) && $this->request->params['action'] != 'login') {
            $this->redirect(array('action' => 'login'));
        }
    }
    
    function stringToSlug($str) {
    	// trim the string
    	$str = strtolower(trim($str));
    	// replace all non valid characters and spaces with an underscore
    	$str = preg_replace('/[^a-z0-9-]/', '-', $str);
    	$str = preg_replace('/-+/', "-", $str);
    return $str;
    }
    
    function login() {
        $this->layout = 'admin_login';
        if (!empty($this->data['email'])) {
            $error = 0;
            if(!filter_var($this->data['email'], FILTER_VALIDATE_EMAIL) || empty($this->data['email'])) {
                $this->Session->setFlash('Invalid Email', '');
                $error++;
            }
            if(!preg_match('/[a-z0-9-]/', $this->data['password']) || empty($this->data['password'])) {
                $this->Session->setFlash('Invalid Password.', '');
                $error++;
            }
            if($error == 0) {
                App::import('Model', 'User');
                $User = new User();
                $hashPassword = Security::hash($this->data['password'], null, true);
                $is_admin = $User->findByEmailAndPasswordAndLevel($this->data['email'], $hashPassword, 5);                
                if($is_admin['User']['id'] > 0) {
                    $this->Session->write('UserData', $is_admin);
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('User not found.', '');
                }
            }
        }
    }
    
    function uploadFiles($folder, $formdata, $itemId = null, $file_name = 'original') {
    	// setup dir names absolute and relative
    	$folder_url = WWW_ROOT.$folder;
    	$rel_url = $folder;
    	// create the folder if it does not exist
    	if(!is_dir($folder_url)) {
    		mkdir($folder_url);
    	}
    		
    	// if itemId is set create an item folder
    	if($itemId) {
    		// set new absolute folder
    		$folder_url = WWW_ROOT.$folder.'/'.$itemId; 
    		// set new relative folder
    		$rel_url = $folder.'/'.$itemId;
    		// create directory
    		if(!is_dir($folder_url)) {
    			mkdir($folder_url);
    		}
    	}
    	
    	// list of permitted file types, this is only images but documents can be added
    	$permitted = array('image/gif','image/jpeg','image/jpeg','image/png');
    	// loop through and deal with the files
    	   $file = array('name' => $formdata['name'],'type' => $formdata['type'], 'tmp_name' => $formdata['tmp_name'],
            'error' => $formdata['error'], 'size' => $formdata['size']);
    		// replace spaces with underscores
    		$filename = $file_name.'.'.end(explode('/', $formdata['type']));
    		// assume filetype is false
    		$typeOK = false;
    		// check filetype is ok
    		foreach($permitted as $type) {
    			if($type == $file['type']) {
    				$typeOK = true;
    				break;
    			}
    		}
    		
    		// if file type ok upload the file
    		if($typeOK) {
    			// switch based on error code
    			switch($filename['error']) {
    				case 0:
    					// check filename already exists
    					if(!file_exists($folder_url.'/'.$filename)) {
    						// create full filename
    						$full_url = $folder_url.'/'.$filename;
    						$url = $rel_url.'/'.$filename;
    						// upload the file
    						$success = move_uploaded_file($file['tmp_name'], $url);
    					} else {
    						// create unique filename and upload file
    						$full_url = $folder_url.'/'.$filename;
    						$url = $rel_url.'/'.$filename;
    						$success = move_uploaded_file($file['tmp_name'], $url);
    					}
    					// if upload was successful
    					if($success) {
    						// save the url of the file
    						return end(explode('.', $filename));
    					} else {
    						$result['errors'][] = "Error uploaded $filename. Please try again.";
    					}
    					break;
    				case 3:
    					// an error occured
    					$result['errors'][] = "Error uploading $filename. Please try again.";
    					break;
    				default:
    					// an error occured
    					$result['errors'][] = "System error uploading $filename. Contact webmaster.";
    					break;
    			}
    		} elseif($file['error'] == 4) {
    			// no file was selected for upload
    			$result['nofiles'][] = "No file Selected";
    		} else {
    			// unacceptable file type
    			$result['errors'][] = "$filename cannot be uploaded. Acceptable file types: gif, jpg, png.";
    		}
    	
    return $result;
    } 
    
    function add_category() {
        if(!empty($this->data['title'])) {
            App::import('Model', 'Category');
            $Category = new Category();  
            $Category->create();        
            if($Category->save($this->data)) {  
                $this->redirect(array('action' => 'all_categories')); 
            }
        }
        $this->layout = 'admin';
    }
    
    function add_user() {
        if(!empty($this->data['email'])) {
            App::import('Model', 'User');
            $User = new User();  
            $User->create(); 
            if($this->data['password'] != $this->data['password2']) {
               $this->set('errpass', '1');
               $this->set('post', $_POST);
            } else {
                $data = $this->data;
                $data['password'] = Security::hash($this->data['password'], null, true);            
                if($User->save($data)) {  
                    $this->redirect(array('action' => 'all_users')); 
                }                
            }
        }
        $this->layout = 'admin';
    } 
    
    function edit_user($id) {
        App::import('Model', 'User');
        $User = new User();       
        $User->read(null, $id);   
        $this->set('User', $User);
        if(!empty($this->data['email'])) {
            if($this->data['password'] != $this->data['password2']) {
               $this->set('errpass', '1');
            } else {
                $data = $this->data;
                $data['password'] = Security::hash($this->data['password'], null, true);            
                if($User->save($data)) {  
                    $this->redirect(array('action' => 'all_users')); 
                }                
            }            

        }
        $this->layout = 'admin';
    }       
    
    function edit_category($id) {
        App::import('Model', 'Category');
        $Category = new Category();       
        $Category->read(null, $id);   
        $this->set('Category', $Category);
        if(!empty($this->data['title'])) {
            if($Category->save($this->data)) {  
                $this->redirect(array('action' => 'all_categories')); 
            }
        }
        $this->layout = 'admin';
    }
    
    function edit_page($id) {
        App::import('Model', 'Pages');
        $Pages = new Pages();     
        $Pages->read(null, $id);
        $this->set('Pages', $Pages);   
        if(!empty($this->data['title'])) {
            $data = $this->data;
            $data['status'] = 1;
            if(empty($data['slug'])) {
                $data['slug'] = $this->stringToSlug($this->data['title']);    
            }
            $user_data = $this->Session->read('UserData');
            $data['created_by'] = $user_data['User']['id'];        
            if($Pages->save($data)) {
                $this->redirect(array('action' => 'add_page_done', $Pages->id));
            }                         
        }
        App::import('Model', 'Category');
        $Category = new Category();
        $this->set('categories', $Category->find('all'));        
        $this->layout = 'admin';
    }    
    
    function add_page() {
        if(!empty($this->data['title'])) {
            $data = $this->data;
            $data['status'] = 1;
            if(empty($data['slug'])) {
                $data['slug'] = $this->stringToSlug($this->data['title']);    
            }
            $user_data = $this->Session->read('UserData');
            $data['created_by'] = $user_data['User']['id'];
            $data['created'] = date("Y-m-d");
            App::import('Model', 'Pages');
            $Pages = new Pages();  
            $Pages->create();
            if($Pages->save($data)) {
                $this->redirect(array('action' => 'add_page_done', $Pages->id));
            }                         
        }
        App::import('Model', 'Category');
        $Category = new Category();
        $this->set('categories', $Category->find('all'));        
        $this->layout = 'admin';
    }
    
    function ajax_pages_change_order() {
        App::import('Model', 'Pages');
        $Pages = new Pages();     
        $Pages->read(null, $_POST['asocid']);
        if($Pages->save(array('orden' => $_POST['order']))) {
            echo json_encode(array('error' => ''));
        } else {
            echo json_encode(array('error' => 'error'));
        }
         
        $this->layout = 'ajax';        
    }
    
    function add_event() {
        if(!empty($this->data['title'])) {
            $errors = array();            
            if(!empty($_FILES['event_image'])) {
                $data = $this->data;
                $data['status'] = 1;
                if(empty($data['slug'])) {
                    $data['slug'] = $this->stringToSlug($this->data['title']);    
                }                
                $data['created'] = date("Y-m-d");
                
                App::import('Model', 'Event');
                $Event = new Event();  
                $Event->create();        
                if($Event->save($data)) {
                    $this->uploadFiles('uploaded_images', $_FILES['event_image'], $Event->id);
                    $img_ext = end(explode('/', $_FILES['event_image']['type']));
                    if(!empty($img_ext)) {
                        $Event->save(array('presentation_image' => $img_ext));
                    }
                    if(!empty($this->data['categories'])) {
                        App::import('Model', 'CategoryToEvent');
                        $CategoryToEvent = new CategoryToEvent();
                        foreach($this->data['categories'] as $key => $cat) {
                            if(empty($cat)) continue;
                            $CategoryToEvent->create();
                            $cat_data = array('event_id' => $Event->id, 'category_id' => $cat);
                            $CategoryToEvent->save($cat_data);                            
                        }
                    } 
                $this->redirect(array('action' => 'add_event_step_2', $Event->id));       
                }                              
            }
        }
        App::import('Model', 'Category');
        $Category = new Category();
        $this->set('categories', $Category->find('all'));
        $this->layout = 'admin';
    } 
    
    function edit_event($id) {
        App::import('Model', 'Event');
        $Event = new Event();  
        $Event->read(null, $id);        
        if(!empty($this->data['title'])) {
            $errors = array();            
            if(!empty($_FILES['event_image'])) {
                $data = $this->data;
                $data['status'] = 1;
                if(empty($data['slug'])) {
                    $data['slug'] = $this->stringToSlug($this->data['title']);    
                }     
                if($Event->save($data)) {
                    $this->uploadFiles('uploaded_images', $_FILES['event_image'], $Event->id);
                    $img_ext = end(explode('/', $_FILES['event_image']['type']));
                    if(!empty($img_ext)) {
                        $Event->save(array('presentation_image' => $img_ext));
                    }
                    if(!empty($this->data['categories'])) {
                        App::import('Model', 'CategoryToEvent');
                        $CategoryToEvent = new CategoryToEvent();
                        $cats_ev = $CategoryToEvent->findAllByEventId($id);
                        foreach($cats_ev as $key => $catdel) {
                            $CategoryToEvent->delete($catdel['CategoryToEvent']['id']);
                        }                        
                        foreach($this->data['categories'] as $key => $cat) {
                            if(empty($cat)) continue;
                            $CategoryToEvent->create();
                            $cat_data = array('event_id' => $Event->id, 'category_id' => $cat);
                            $CategoryToEvent->save($cat_data);                            
                        }
                    } 
                $this->redirect(array('action' => 'edit_event_step_2', $Event->id));       
                }                              
            }
        }
        App::import('Model', 'Category');
        $Category = new Category();
        $this->set('categories', $Category->find('all'));
        $ids_cats = array();
        App::import('Model', 'CategoryToEvent');
        $CategoryToEvent = new CategoryToEvent();
        $event_Cats = $CategoryToEvent->findAllByEventId($id);
        foreach($event_Cats as $key => $cat) {
            $ids_cats[] = $cat['CategoryToEvent']['category_id'];
        }
        $this->set('event_categories', $ids_cats);
        $this->set('Event', $Event);
        $this->layout = 'admin';
    } 
    
    function edit_event_step_2($id) {
        App::import('Model', 'Event');
        $Event = new Event();
        $Event->read(null, $id); 
        if(!empty($this->data['step2'])) {
            if($Event->save($this->data)) {
                $this->redirect(array('action' => 'edit_event_step_3', $id));
            }           
        }
        $this->set('Event', $Event);
        $this->layout = 'admin';
    }       
    
    function add_event_step_2($id) {
        if(!empty($this->data['step2'])) {
            App::import('Model', 'Event');
            $Event = new Event();
            $Event->read(null, $id); 
            if($Event->save($this->data)) {
                $this->redirect(array('action' => 'add_event_step_3', $id));
            }           
        }
        $this->layout = 'admin';
    }

    function edit_event_step_3($id) {
        App::import('Model', 'Event');
        $Event = new Event();
        $Event->read(null, $id);        
        $img_ext = $Event->data['Event']['sectors_image'];
        $this->set('Event', $Event);
        App::import('Model', 'Pricing');
        $Pricing = new Pricing();
        $pricings_ev = $Pricing->findAllByEventId($id); 
        $this->set('pricings', $pricings_ev);                 
        if(!empty($this->data['step3'])) {       
            if(!empty($_FILES['sectors_image']['name'])) {
                $this->uploadFiles('uploaded_images', $_FILES['sectors_image'], $id, 'sectors');
                $img_ext = end(explode('/', $_FILES['sectors_image']['type']));
                $Event->save(array('sectors_image' => $img_ext));
                $this->set('event_id', $id);
                $this->set('extension', $img_ext);
                $this->set('have_image', '1');                
            } else {
                if(is_array($this->data['sector'])) {
                    foreach($pricings_ev as $key => $pridel) {
                        $Pricing->delete($pridel['Pricing']['id']);
                    }                                              
                    foreach($this->data['sector'] as $key => $sector) {
                        if(empty($sector)) continue;
                        $Pricing = new Pricing();                        
                        $Pricing->create();
                        $Pricing->save(array(
                            'sector_name' => $sector,
                            'price' => $this->data['price'][$key],
                            'service_price' => $this->data['servprice'][$key],
                            'stock' => $this->data['stock'][$key],
                            'hex_color' => $this->data['color'][$key],
                            'url' => $this->data['url'][$key],
                            'event_id' => $id
                        ));                        
                    }
                }
                if($Event->save(array('max_tickets' => $this->data['max_tickets']))) {
                    $this->redirect(array('action' => 'edit_event_step_4', $id));
                }               
            }           
        }
        
        $this->layout = 'admin';
    }
    
    function add_event_step_3($id) {
        if(!empty($this->data['step3'])) {
                App::import('Model', 'Event');
                $Event = new Event();
                $Event->read(null, $id);        
            if(!empty($_FILES['sectors_image']['name'])) {
                $this->uploadFiles('uploaded_images', $_FILES['sectors_image'], $id, 'sectors');
                $img_ext = end(explode('/', $_FILES['sectors_image']['type']));
                $Event->save(array('sectors_image' => $img_ext));
                $this->set('event_id', $id);
                $this->set('extension', $img_ext);
                $this->set('have_image', '1');                
            } else {
                if(is_array($this->data['sector'])) {
                    foreach($this->data['sector'] as $key => $sector) {
                        if(empty($sector)) continue;
                        App::import('Model', 'Pricing');
                        $Pricing = new Pricing();
                        $Pricing->create();
                        $Pricing->save(array(
                            'sector_name' => $sector,
                            'price' => $this->data['price'][$key],
                            'service_price' => $this->data['servprice'][$key],
                            'stock' => $this->data['stock'][$key],
                            'hex_color' => $this->data['color'][$key],
                            'url' => $this->data['url'][$key],
                            'event_id' => $id
                        ));                        
                    }
                }
                if($Event->save(array('max_tickets' => $this->data['max_tickets']))) {
                    $this->redirect(array('action' => 'add_event_step_4', $id));
                }               
            }           
        }
        $this->layout = 'admin';
    }
    
    function edit_event_step_4($id) {
        App::import('Model', 'Event');
        $Event = new Event();
        $Event->read(null, $id);
        $this->set('Event', $Event);
        if(!empty($this->data['step4'])) {
            $Event->save(array(
            'event_start_at' => $this->data['date']." ".$this->data['hour'].":".$this->data['minutes'], 
            'tickets_availables_on' => $this->data['date2']
            ));                    
            $this->redirect(array('action' => 'add_event_done', $id));
        }
        $this->layout = 'admin';
    }    
    
    function add_event_step_4($id) {
        if(!empty($this->data['step4'])) {
            App::import('Model', 'Event');
            $Event = new Event();
            $Event->read(null, $id);
            App::import('Model', 'Dates');
            App::import('Model', 'CategoryToEvent');
            
            foreach($this->data['date'] as $key => $date) {                
                if($key == 0) {
                    $Event->save(array(
                    'event_start_at' => $date." ".$this->data['hour'][$key].":".$this->data['minutes'][$key], 
                    'tickets_availables_on' => $this->data['date2'][$key]
                    ));                    
                } else {
                    if($this->data['create_event'] == 1) {
                        $Event2 = new Event();
                        $Event2->create();
                        $Event2->read(null, $id);
                        $Event2->set('event_start_at', $date." ".$this->data['hour'][$key].":".$this->data['minutes'][$key]);
                        $Event2->set('tickets_availables_on', $this->data['date2'][$key]);
                        $Event2->set('id', '');
                        if($Event2->save()) {
                            $folder_url = WWW_ROOT.'uploaded_images/'.$id;
                    		$folder_url2 = WWW_ROOT.'uploaded_images/'.$Event2->id; 
                    		if(!is_dir($folder_url2)) {
                    			mkdir($folder_url2);
                    		}
                            $Event->read(null, $id);
                            copy($folder_url.'/original.'.$Event->data['Event']['presentation_image'], $folder_url2.'/original.'.$Event->data['Event']['presentation_image']);
                            copy($folder_url.'/sectors.'.$Event->data['Event']['sectors_image'], $folder_url2.'/sectors.'.$Event->data['Event']['sectors_image']);
                            
                            $CategoryToEvent = new CategoryToEvent();
                            $categories = $CategoryToEvent->findAllByEventId($id);
                            foreach($categories as $key => $cat) {
                                $CategoryToEvent2 = new CategoryToEvent();
                                $CategoryToEvent2->create();
                                $CategoryToEvent2->set('id', '');
                                $CategoryToEvent2->set($cat);
                                $CategoryToEvent2->set('event_id', $Event2->id);
                                $CategoryToEvent2->save();
                            }
                            App::import('Model', 'Pricing');
                            $Pricing = new Pricing();
                            $pricings = $Pricing->findAllByEventId($id);
                            foreach($pricings as $key => $price) {
                                $Pricing2 = new Pricing();
                                $Pricing2->create();
                                $Pricing2->set($price);
                                $Pricing2->set('id', '');
                                $Pricing2->set('event_id', $Event2->id);
                                $Pricing2->save();                         
                            }                         
                        }                         
                    } else {
                        $Dates = new Dates();
                        $Dates->create();
                        $Dates->set('event_id', $id);
                        $Dates->set('created', date("Y-m-d H:i:s"));
                        $Dates->set('event_day_date', $date." ".$this->data['hour'][$key].":".$this->data['minutes'][$key]);
                        $Dates->set('tickes_availables_on', $this->data['date2'][$key]);
                        $Dates->save();                       
                    }
                                                  
                }                 
            }
            $this->redirect(array('action' => 'add_event_done', $id));
        }
        $this->layout = 'admin';
    }
    
    function add_page_done($id) {
        $this->layout = 'admin';
    }    
    
    function add_event_done($id) {
        $this->layout = 'admin';
    }
    
    function ajax_get_all_pages_page() {
        $options['order'] = 'Pages.'.$_POST['order_field'].' '.$_POST['order_dir'];
        App::import('Model', 'Pages');
        $Pages = new Pages();     
        $items_per_page = $_POST['items_per_page'];          
        $start = ($_POST['page']-1)*$items_per_page;
        $limit = $items_per_page;  
        $options['limit'] = $start.','.$limit;
        $current_pages = $Pages->find('all', $options);
        $this->set('pages', $current_pages);   
        $this->layout = 'ajax';        
    }    
    
    function ajax_get_all_events_page() {
        $options['order'] = 'Event.'.$_POST['order_field'].' '.$_POST['order_dir'];
        App::import('Model', 'Event');
        $Event = new Event();     
        $items_per_page = $_POST['items_per_page'];          
        $start = ($_POST['page']-1)*$items_per_page;
        $limit = $items_per_page;  
        $options['limit'] = $start.','.$limit;
        $current_events = $Event->find('all', $options);
        $this->set('events', $current_events);   
        $this->layout = 'ajax';        
    }
    
    function ajax_get_all_users_page() {
        $options['order'] = 'User.'.$_POST['order_field'].' '.$_POST['order_dir'];
        App::import('Model', 'User');
        $User = new User();     
        $items_per_page = $_POST['items_per_page'];          
        $start = ($_POST['page']-1)*$items_per_page;
        $limit = $items_per_page;  
        $options['limit'] = $start.','.$limit;
        $current_users = $User->find('all', $options);
        $this->set('users', $current_users);   
        $this->layout = 'ajax';        
    }    
    
    function ajax_get_all_categories_page() {
        $options['order'] = 'Category.'.$_POST['order_field'].' '.$_POST['order_dir'];
        App::import('Model', 'Category');
        $Category = new Category();     
        $items_per_page = $_POST['items_per_page'];          
        $start = ($_POST['page']-1)*$items_per_page;
        $limit = $items_per_page;  
        $options['limit'] = $start.','.$limit;
        $current_categories = $Category->find('all', $options);
        $this->set('categories', $current_categories);   
        $this->layout = 'ajax';        
    }    
    
    function ajax_user_actions() {
        App::import('Model', 'User');
        $array_ids = array();
        if(is_numeric($_POST['id'])) {
            $id = $_POST['id'];
            $array_ids[] = $id;    
        } else {
            $id = explode(',', $_POST['id']);
            $array_ids = $id;
        }
        
        foreach($array_ids as $k => $itemid) {
            $User = new User();
            $User->read(null, $itemid);
            switch($_POST['action']) {
                case 'remove':
                    $User->delete($itemid);
                break;
                case 'unpublish':
                    $User->save(array('status' => 0));
                break;
                case 'publish':
                    $User->save(array('status' => 1));
                break;
            }            
        }
        echo json_encode(array('error' => 0));
        $this->layout = 'ajax';
    }    
    
    function ajax_event_actions() {
        App::import('Model', 'Event');
        $array_ids = array();
        if(is_numeric($_POST['id'])) {
            $id = $_POST['id'];
            $array_ids[] = $id;    
        } else {
            $id = explode(',', $_POST['id']);
            $array_ids = $id;
        }
        
        foreach($array_ids as $k => $itemid) {
            $Event= new Event();
            $Event->read(null, $itemid);
            switch($_POST['action']) {
                case 'remove':
                    $Event->delete($itemid);
                break;
                case 'unpublish':
                    $Event->save(array('status' => 0));
                break;
                case 'publish':
                    $Event->save(array('status' => 1));
                break;
            }            
        }
        echo json_encode(array('error' => 0));
        $this->layout = 'ajax';
    }
    
    function ajax_pages_actions() {
        App::import('Model', 'Pages');
        $array_ids = array();
        if(is_numeric($_POST['id'])) {
            $id = $_POST['id'];
            $array_ids[] = $id;    
        } else {
            $id = explode(',', $_POST['id']);
            $array_ids = $id;
        }
        
        foreach($array_ids as $k => $itemid) {
            $Pages = new Pages();
            $Pages->read(null, $itemid);
            switch($_POST['action']) {
                case 'remove':
                    $Pages->delete($itemid);
                break;
                case 'unpublish':
                    $Pages->save(array('status' => 0));
                break;
                case 'publish':
                    $Pages->save(array('status' => 1));
                break;
            }            
        }
        echo json_encode(array('error' => 0, 'ids' => $array_ids));
        $this->layout = 'ajax';
    }    
    
    function ajax_category_actions() {
        App::import('Model', 'Category');
        $array_ids = array();
        if(is_numeric($_POST['id'])) {
            $id = $_POST['id'];
            $array_ids[] = $id;    
        } else {
            $id = explode(',', $_POST['id']);
            $array_ids = $id;
        }
        
        foreach($array_ids as $k => $itemid) {
            $Category = new Category();
            $Category->read(null, $itemid);
            switch($_POST['action']) {
                case 'remove':
                    $Category->delete($itemid);
                break;
                case 'unpublish':
                    $Category->save(array('enabled' => 0));
                break;
                case 'publish':
                    $Category->save(array('enabled' => 1));
                break;
            }            
        }
        echo json_encode(array('error' => 0));
        $this->layout = 'ajax';
    }    
    
    function all_users() {
        $options['order'] = 'User.email ASC';
        App::import('Model', 'User');
        $User = new User();     
        $default_items_per_page = 5;      
        $all_users = $User->find('all', $options);
        $options['limit'] = $default_items_per_page;
        $current_users = $User->find('all', $options);
        $this->set('users', $current_users);   
        $this->set('items_per_page', $default_items_per_page);
        $this->set('total_items', count($all_users));
        $this->set('total_pages', ceil(count($all_users)/$default_items_per_page));
        $this->layout = 'admin';
    }    
    
    function all_events() {
        $options['order'] = 'Event.event_start_at ASC';
        App::import('Model', 'Event');
        $Event = new Event();     
        $default_items_per_page = 5;      
        $all_events = $Event->find('all', $options);
        $options['limit'] = $default_items_per_page;
        $current_events = $Event->find('all', $options);
        $this->set('events', $current_events);   
        $this->set('items_per_page', $default_items_per_page);
        $this->set('total_items', count($all_events));
        $this->set('total_pages', ceil(count($all_events)/$default_items_per_page));
        $this->layout = 'admin';
    }
    
    function all_pages() {
        $options['order'] = 'Pages.title ASC';
        App::import('Model', 'Pages');
        $Pages = new Pages();     
        $default_items_per_page = 5;      
        $all_pages = $Pages->find('all', $options);
        $options['limit'] = $default_items_per_page;
        $current_pages = $Pages->find('all', $options);
        $this->set('pages', $current_pages);   
        $this->set('items_per_page', $default_items_per_page);
        $this->set('total_items', count($all_pages));
        $this->set('total_pages', ceil(count($all_pages)/$default_items_per_page));
        $this->layout = 'admin';
    }    
    
    function all_categories() {
        $options['order'] = 'Category.title ASC';
        App::import('Model', 'Category');
        $Category = new Category();     
        $default_items_per_page = 5;      
        $all_categories = $Category->find('all', $options);
        $options['limit'] = $default_items_per_page;
        $current_categories = $Category->find('all', $options);
        $this->set('categories', $current_categories);   
        $this->set('items_per_page', $default_items_per_page);
        $this->set('total_items', count($all_categories));
        $this->set('total_pages', ceil(count($all_categories)/$default_items_per_page));
        $this->layout = 'admin';
    }  
    
    function cofiguration() {
        App::import('Model', 'Configuration');
        $Configuration = new Configuration();        
    }  
    
    function index() {
        $this->layout = 'admin';
    }        
}