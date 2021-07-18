<?php
require('fpdf/fpdf.php');

class PDF_MySQL_Table extends FPDF
{
	var $ProcessingTable=false;
	var $aCols=array();
	var $TableX;
	var $HeaderColor;
	var $RowColors;
	var $ColorIndex;

	function Header()
	{
		//Print the table header if necessary
		if($this->ProcessingTable)
			$this->TableHeader();
	}
	
	function TableHeader($timesheet_id)
	{
		$translate = Zend_Registry::get('translate');
		$db = Zend_Registry::get('dbAdapter');
		$indentifier[0] = "hour_status_id";
		$indentifier[1] = "project_id";
		$indentifier[2] = "action_date";
		$indentifier[3] = "action_time_start";
		$indentifier[4] = "action_time_end";
		$indentifier[5] = "NORMI_PAIVA";
		$indentifier[6] = "la";
		$indentifier[7] = "su";
		$indentifier[8] = "lisat_ilta";
		$indentifier[9] = "lisat_yo";
		$indentifier[10] = "ylityo_vrk_50";
		$indentifier[11] = "ylityo_vrk_100";
		$indentifier[12] = "ylityo_viik_50";
		$indentifier[13] = "ylityo_viik_100";
		$indentifier[14] = "ATV";
		$indentifier[15] = "matka_tunnit";
		$indentifier[16] = "paivaraha_osa";
		$indentifier[17] = "paivaraha_koko";
		$indentifier[18] = "ateria_korvaus";
		$indentifier[19] = "km_korvaus";
		$indentifier[20] = "tyokalu_korvaus";
		$indentifier[21] = "km_description";
		$indentifier[22] = "HUOMIOITA";
		$indentifier[23] = "memo";
		$i=0;
		$this->SetFont('Arial','B',6);
		$this->SetX($this->TableX);
		$fill=!empty($this->HeaderColor);
		if($fill)
			$this->SetFillColor($this->HeaderColor[0],$this->HeaderColor[1],$this->HeaderColor[2]);
		foreach($this->aCols as $col) {
			$select_row = $col['c'];
			
			//echo $col['c'];
			
			/*if ($indentifier[$i]=="NORMI_PAIVA") {
				$row = $db->fetchone("SELECT SUM($select_row) FROM hrm_timesheet_hours_dates WHERE timesheet_id = ".$timesheet_id.";");
				if ($row=="0.00") {
			
				} else {
					$this->Cell($col['w'],6,$col['c'],1,0,'C',$fill);
				}
			
			} else if ($indentifier[$i]=="la") {
				
			$row = $db->fetchone("SELECT SUM($select_row) FROM hrm_timesheet_hours_dates WHERE timesheet_id = ".$timesheet_id.";");
			if ($row=="0.00") {
				
			} else {
				$this->Cell($col['w'],6,$col['c'],1,0,'C',$fill);
			}
			
			} else if ($indentifier[$i]=="su") {
				
				$row = $db->fetchone("SELECT SUM($select_row) FROM hrm_timesheet_hours_dates WHERE timesheet_id = ".$timesheet_id.";");
				
				if ($row=="0.00") {
				
				} else {
					$this->Cell($col['w'],6,$col['c'],1,0,'C',$fill);
				}
				
				} else if ($indentifier[$i]=="lisat_ilta") {
				
					$row = $db->fetchone("SELECT SUM($select_row) FROM hrm_timesheet_hours_dates WHERE timesheet_id = ".$timesheet_id.";");
				
					if ($row=="0.00") {
				
					} else {
						$this->Cell($col['w'],6,$col['c'],1,0,'C',$fill);
					}
					
					} else if ($indentifier[$i]=="lisat_yo") {
					
						$row = $db->fetchone("SELECT SUM($select_row) FROM hrm_timesheet_hours_dates WHERE timesheet_id = ".$timesheet_id.";");
					
						if ($row=="0.00") {
					
						} else {
							$this->Cell($col['w'],6,$col['c'],1,0,'C',$fill);
						}
						
						} else if ($indentifier[$i]=="ylityo_vrk_50") {
								
							$row = $db->fetchone("SELECT SUM($select_row) FROM hrm_timesheet_hours_dates WHERE timesheet_id = ".$timesheet_id.";");
								
							if ($row=="0.00") {
									
							} else {
								$this->Cell($col['w'],6,$col['c'],1,0,'C',$fill);
							}
							
						    } else if ($indentifier[$i]=="ylityo_vrk_100") {
							
								$row = $db->fetchone("SELECT SUM($select_row) FROM hrm_timesheet_hours_dates WHERE timesheet_id = ".$timesheet_id.";");
							
								if ($row=="0.00") {
										
								} else {
									$this->Cell($col['w'],6,$col['c'],1,0,'C',$fill);
								}
								
								} else if ($indentifier[$i]=="ylityo_viik_50") {
										
									$row = $db->fetchone("SELECT SUM($select_row) FROM hrm_timesheet_hours_dates WHERE timesheet_id = ".$timesheet_id.";");
										
									if ($row=="0.00") {
								
									} else {
										$this->Cell($col['w'],6,$col['c'],1,0,'C',$fill);
									}
									
									} else if ($indentifier[$i]=="ylityo_viik_100") {
									
										$row = $db->fetchone("SELECT SUM($select_row) FROM hrm_timesheet_hours_dates WHERE timesheet_id = ".$timesheet_id.";");
									
										if ($row=="0.00") {
									
										} else {
											$this->Cell($col['w'],6,$col['c'],1,0,'C',$fill);
										}
										
										} else if ($indentifier[$i]=="ATV") {
												
											$row = $db->fetchone("SELECT SUM($select_row) FROM hrm_timesheet_hours_dates WHERE timesheet_id = ".$timesheet_id.";");
												
											if ($row=="0.00") {
													
											} else {
												$this->Cell($col['w'],6,$col['c'],1,0,'C',$fill);
											}
											
											} else if ($indentifier[$i]=="matka_tunnit") {
											
												$row = $db->fetchone("SELECT SUM($select_row) FROM hrm_timesheet_hours_dates WHERE timesheet_id = ".$timesheet_id.";");
											
												if ($row=="0.00") {
														
												} else {
													$this->Cell($col['w'],6,$col['c'],1,0,'C',$fill);
												}
												
												} else if ($indentifier[$i]=="paivaraha_osa") {
														
													$row = $db->fetchone("SELECT SUM($select_row) FROM hrm_timesheet_hours_dates WHERE timesheet_id = ".$timesheet_id.";");
														
													if ($row=="0") {
												
													} else {
														$this->Cell($col['w'],6,$col['c'],1,0,'C',$fill);
													}
													
													} else if ($indentifier[$i]=="paivaraha_koko") {
													
														$row = $db->fetchone("SELECT SUM($select_row) FROM hrm_timesheet_hours_dates WHERE timesheet_id = ".$timesheet_id.";");
													
														if ($row=="0") {
													
														} else {
															$this->Cell($col['w'],6,$col['c'],1,0,'C',$fill);
														}
														
														} else if ($indentifier[$i]=="ateria_korvaus") {
																
															$row = $db->fetchone("SELECT SUM($select_row) FROM hrm_timesheet_hours_dates WHERE timesheet_id = ".$timesheet_id.";");
																
															if ($row=="0") {
																	
															} else {
																$this->Cell($col['w'],6,$col['c'],1,0,'C',$fill);
															}
														
														} else if ($indentifier[$i]=="km_korvaus") {
																
															$row = $db->fetchone("SELECT SUM($select_row) FROM hrm_timesheet_hours_dates WHERE timesheet_id = ".$timesheet_id.";");
																
															if ($row=="0") {
																	
															} else {
																$this->Cell($col['w'],6,$col['c'],1,0,'C',$fill);
															}
															
															} else if ($indentifier[$i]=="tyokalu_korvaus") {
															
																$row = $db->fetchone("SELECT SUM($select_row) FROM hrm_timesheet_hours_dates WHERE timesheet_id = ".$timesheet_id.";");
															
																if ($row=="0") {
																		
																} else {
																	$this->Cell($col['w'],6,$col['c'],1,0,'C',$fill);
																}

																} else if ($indentifier[$i]=="HUOMIOITA") {
																	
																	$this->Cell($col['w'],6,$col['c'],1,0,'C',$fill);
																	
			/*} else {*/
			$this->Cell($col['w'],6,utf8_decode($translate->_($col['c'])),1,0,'C',$fill);
			//}
			$i++;
		}
		//echo $i;
		$this->Ln();
	}

	function Row($data)
	{
		$this->SetX($this->TableX);
		$ci=$this->ColorIndex;
		$fill=!empty($this->RowColors[$ci]);
		if($fill)
			$this->SetFillColor($this->RowColors[$ci][0],$this->RowColors[$ci][1],$this->RowColors[$ci][2]);
		foreach($this->aCols as $col) {
			$row = (string) $data[$col['f']];
			/*if ($row=="0.00") {
				$row = (string) "";
				$this->Cell($col['w'],5,utf8_decode($row),1,0,$col['a'],$fill);
			} else if ($row=="1970-01-01") {
				$row = (string) "";
				$this->Cell($col['w'],5,utf8_decode($row),1,0,$col['a'],$fill);
			} else if ($row=="00:00:00") {
				$row = (string) "";
				$this->Cell($col['w'],5,utf8_decode($row),1,0,$col['a'],$fill);
			} else if ($col['c']=="hour_status_id" && $row=="4") {
				$row = (string) "";
				$this->Cell($col['w'],5,utf8_decode($row),1,0,$col['a'],$fill);
			} else {
				$this->Cell($col['w'],5,utf8_decode($row),1,0,$col['a'],$fill);
			}*/
			$this->Cell($col['w'],5,utf8_decode($row),1,0,$col['a'],$fill);
		}
		$this->Ln();
		$this->ColorIndex=1-$ci;
	}
	
	function RowFooter($data,$timesheet_id)
	{
		$db = Zend_Registry::get('dbAdapter');
		$this->SetX($this->TableX);
		$ci=$this->ColorIndex;
		$fill=!empty($this->RowColors[$ci]);
		if($fill)
			$this->SetFillColor($this->RowColors[$ci][0],$this->RowColors[$ci][1],$this->RowColors[$ci][2]);
		foreach($this->aCols as $col) {
			$row = (string) $data[$col['f']];
			//if ($row=="0.00") {
			//	$row = (string) "";
			//}
			//print_r($col);
			/*$indentifier[0] = "hour_status_id";
			$indentifier[1] = "project_id";
			$indentifier[2] = "action_date";
			$indentifier[3] = "action_time_start";
			$indentifier[4] = "action_time_end";
			$indentifier[5] = "NORMI_PAIVA";
			$indentifier[6] = "la";
			$indentifier[7] = "su";
			$indentifier[8] = "lisat_ilta";
			$indentifier[9] = "lisat_yo";
			$indentifier[10] = "ylityo_vrk_50";
			$indentifier[11] = "ylityo_vrk_100";
			$indentifier[12] = "ylityo_viik_50";
			$indentifier[13] = "ylityo_viik_100";
			$indentifier[14] = "ATV";
			$indentifier[15] = "matka_tunnit";
			$indentifier[16] = "paivaraha_osa";
			$indentifier[17] = "paivaraha_koko";
			$indentifier[18] = "ateria_korvaus";
			$indentifier[19] = "km_korvaus";
			$indentifier[20] = "tyokalu_korvaus";
			$indentifier[21] = "km_description";
			$indentifier[22] = "HUOMIOITA";
			$indentifier[23] = "memo";*/
			
			if ($col['c']=="hour_status_id") {
			    $this->Cell($col['w'],5,"",0,0,$col['a'],$fill);
			} else if ($col['c']=="project_id") {
				$this->Cell($col['w'],5,"",0,0,$col['a'],$fill);
		    } else if ($col['c']=="action_date") {
			   $this->Cell($col['w'],5,"",0,0,$col['a'],$fill);
			   } else if ($col['c']=="action_time_start") {
			   	$this->Cell($col['w'],5,"",0,0,$col['a'],$fill);
			   	} else if ($col['c']=="action_time_end") {
			   		$this->Cell($col['w'],5,"",0,0,$col['a'],$fill);
			   		} else if ($col['c']=="km_description") {
			   			$this->Cell($col['w'],5,"",0,0,$col['a'],$fill);
			   			} else if ($col['c']=="HUOMIOITA") {
			   				$this->Cell($col['w'],5,"",0,0,$col['a'],$fill);
			   				} else if ($col['c']=="memo") {
			   					$this->Cell($col['w'],5,"",0,0,$col['a'],$fill);
			   					/*} else if ($col['c']=="paivaraha_osa") {
			   						$this->Cell($col['w'],5,"",0,0,$col['a'],$fill);
			   						} else if ($col['c']=="paivaraha_koko") {
			   							$this->Cell($col['w'],5,"",0,0,$col['a'],$fill);*/
			} else {
				$select_row = $col['c'];
				$row = $db->fetchone("SELECT SUM($select_row) FROM hrm_timesheet_hours_dates WHERE timesheet_id = ".$timesheet_id.";");
				if ($row=="0.00") {
					$row = (string) "";
					$this->Cell($col['w'],5,"",1,0,$col['a'],$fill);
				} else {
				$this->Cell($col['w'],5,$row,1,0,$col['a'],$fill);
				}
			}
		}
		$this->Ln();
		$this->ColorIndex=1-$ci;
	}

	function CalcWidths($width,$align)
	{
		//Compute the widths of the columns
		$TableWidth=0;
		foreach($this->aCols as $i=>$col)
		{
			$w=$col['w'];
			if($w==-1)
				$w=$width/count($this->aCols);
			elseif(substr($w,-1)=='%')
			$w=$w/100*$width;
			$this->aCols[$i]['w']=$w;
			$TableWidth+=$w;
		}
		//Compute the abscissa of the table
		if($align=='C')
			$this->TableX=max(($this->w-$TableWidth)/2,0);
		elseif($align=='R')
		$this->TableX=max($this->w-$this->rMargin-$TableWidth,0);
		else
			$this->TableX=$this->lMargin;
	}

	function AddCol($field=-1,$width=-1,$caption='',$align='L')
	{
		//Add a column to the table
		if($field==-1)
			$field=count($this->aCols);
		$this->aCols[]=array('f'=>$field,'c'=>$caption,'w'=>$width,'a'=>$align);
	}

	function Table($query,$timesheet_id,$prop=array())
	{
		//Issue query
		$translate = Zend_Registry::get('translate');
		$db = Zend_Registry::get('dbAdapter');
		$sql_count = $query;
		$sql = $query;
		$res = $db->query($sql);
		//Add all columns if none was specified
		//echo "test";
		
		$indentifier[0] = "hour_status_id";
		$indentifier[1] = "project_id";
		$indentifier[2] = "action_date";
		$indentifier[3] = "action_time_start";
		$indentifier[4] = "action_time_end";
		$indentifier[5] = "NORMI_PAIVA";
		$indentifier[6] = "la";
		$indentifier[7] = "su";
		$indentifier[8] = "lisat_ilta";
		$indentifier[9] = "lisat_yo";
		$indentifier[10] = "ylityo_vrk_50";
		$indentifier[11] = "ylityo_vrk_100";
		$indentifier[12] = "ylityo_viik_50";
		$indentifier[13] = "ylityo_viik_100";
		$indentifier[14] = "ATV";
		$indentifier[15] = "matka_tunnit";
		$indentifier[16] = "paivaraha_osa";
		$indentifier[17] = "paivaraha_koko";
		$indentifier[18] = "ateria_korvaus";
		$indentifier[19] = "km_korvaus";
		$indentifier[20] = "tyokalu_korvaus";
		$indentifier[21] = "km_description";
		$indentifier[22] = "HUOMIOITA";
		$indentifier[23] = "memo";
		//$i = 0;
		if(count($this->aCols)==0)
		{
			//$db->setFetchMode(Zend_Db::FETCH_NUM);
			//echo "test";
			$nb=count($indentifier);
		    //echo $nb;
			for($i=0;$i<$nb;$i++) {
				/*if ($indentifier[$i]=="hour_status_id") {
					$this->AddCol();
				} else if ($indentifier[$i]=="project_id") {
					$this->AddCol();
				} else if ($indentifier[$i]=="action_date") {
					$this->AddCol();
				} else if ($indentifier[$i]=="action_time_start") {
					$this->AddCol();
				} else if ($indentifier[$i]=="action_time_end") {
					$this->AddCol();
				} else if ($indentifier[$i]=="km_description") {
					$this->AddCol();
				} else if ($indentifier[$i]=="HUOMIOITA") {
					$this->AddCol();
				} else if ($indentifier[$i]=="memo") {
					$this->AddCol();
				} else if ($indentifier[$i]=="NORMI_PAIVA") {
					$select_row = "NORMI_PAIVA";
					$row = $db->fetchone("SELECT SUM($select_row) FROM hrm_timesheet_hours_dates WHERE timesheet_id = ".$timesheet_id.";");
				    if ($row==0.00) {
				       //$this->AddCol();
				    } else {
				       $this->AddCol();
				    }
				} else if ($indentifier[$i]=="la") {
					$select_row = "la";
					$row = $db->fetchone("SELECT SUM($select_row) FROM hrm_timesheet_hours_dates WHERE timesheet_id = ".$timesheet_id.";");
				    if ($row==0.00) {
				       //$this->AddCol();
				    } else {
				       $this->AddCol();
				    }
				    } else if ($indentifier[$i]=="su") {
				    	$select_row = "su";
				    	$row = $db->fetchone("SELECT SUM($select_row) FROM hrm_timesheet_hours_dates WHERE timesheet_id = ".$timesheet_id.";");
				    	if ($row==0.00) {
				    		//$this->AddCol();
				    	} else {
				    		$this->AddCol();
				    	}  
				    	
				    	} else if ($indentifier[$i]=="lisat_ilta") {
				    		$select_row = "lisat_ilta";
				    		$row = $db->fetchone("SELECT SUM($select_row) FROM hrm_timesheet_hours_dates WHERE timesheet_id = ".$timesheet_id.";");
				    		if ($row==0.00) {
				    			//$this->AddCol();
				    		} else {
				    			$this->AddCol();
				    		}
				    		
				    		} else if ($indentifier[$i]=="lisat_yo") {
				    			$select_row = "lisat_yo";
				    			$row = $db->fetchone("SELECT SUM($select_row) FROM hrm_timesheet_hours_dates WHERE timesheet_id = ".$timesheet_id.";");
				    			if ($row==0.00) {
				    				//$this->AddCol();
				    			} else {
				    				$this->AddCol();
				    			}
				    			
				    			} else if ($indentifier[$i]=="ylityo_vrk_50") {
				    				$select_row = "ylityo_vrk_50";
				    				$row = $db->fetchone("SELECT SUM($select_row) FROM hrm_timesheet_hours_dates WHERE timesheet_id = ".$timesheet_id.";");
				    				if ($row==0.00) {
				    					//$this->AddCol();
				    				} else {
				    					$this->AddCol();
				    				}
				    				
				    				} else if ($indentifier[$i]=="ylityo_vrk_100") {
				    					$select_row = "ylityo_vrk_100";
				    					$row = $db->fetchone("SELECT SUM($select_row) FROM hrm_timesheet_hours_dates WHERE timesheet_id = ".$timesheet_id.";");
				    					if ($row==0.00) {
				    						//$this->AddCol();
				    					} else {
				    						$this->AddCol();
				    					}
				    					
				    					} else if ($indentifier[$i]=="ylityo_viik_50") {
				    						$select_row = "ylityo_viik_50";
				    						$row = $db->fetchone("SELECT SUM($select_row) FROM hrm_timesheet_hours_dates WHERE timesheet_id = ".$timesheet_id.";");
				    						if ($row==0.00) {
				    							//$this->AddCol();
				    						} else {
				    							$this->AddCol();
				    						}
				    						
				    						} else if ($indentifier[$i]=="ylityo_viik_100") {
				    							$select_row = "ylityo_viik_100";
				    							$row = $db->fetchone("SELECT SUM($select_row) FROM hrm_timesheet_hours_dates WHERE timesheet_id = ".$timesheet_id.";");
				    							if ($row==0.00) {
				    								//$this->AddCol();
				    							} else {
				    								$this->AddCol();
				    							}
				    							
				    							} else if ($indentifier[$i]=="ATV") {
				    								$select_row = "ATV";
				    								$row = $db->fetchone("SELECT SUM($select_row) FROM hrm_timesheet_hours_dates WHERE timesheet_id = ".$timesheet_id.";");
				    								if ($row==0.00) {
				    									//$this->AddCol();
				    								} else {
				    									$this->AddCol();
				    								}
				
				} else {*/
					$this->AddCol();
				//}
			}
			    //echo "test";
		}
		$i = 0;
		//Retrieve column names when not specified
		foreach($this->aCols as $i=>$col)
		{
		//if($col['c']=='')
			//{
			//if(is_string($col['f'])) {
				$this->aCols[$i]['c']=$indentifier[$i];
			    //} else {
				//$this->aCols[$i]['c']=$indentifier[$i];
			    //}
			    $i++;
			//}
			}
			//Handle properties
			if(!isset($prop['width']))
			$prop['width']=0;
				if($prop['width']==0)
				$prop['width']=$this->w-$this->lMargin-$this->rMargin;
				if(!isset($prop['align']))
				$prop['align']='C';
				if(!isset($prop['padding']))
					$prop['padding']=$this->cMargin;
    $cMargin=$this->cMargin;
    $this->cMargin=$prop['padding'];
    		if(!isset($prop['HeaderColor']))
					$prop['HeaderColor']=array();
					$this->HeaderColor=$prop['HeaderColor'];
					if(!isset($prop['color1']))
					$prop['color1']=array();
							if(!isset($prop['color2']))
							$prop['color2']=array();
							$this->RowColors=array($prop['color1'],$prop['color2']);
							//Compute column widths
							$this->CalcWidths($prop['width'],$prop['align']);
							//Print header
							$this->TableHeader($timesheet_id);
							//Print rows
									$this->SetFont('Arial','',8);
									$this->ColorIndex=0;
									$this->ProcessingTable=true;
									$db->setFetchMode(Zend_Db::FETCH_NUM);
									$i = 0;
									$rows = count($db->fetchAll($sql_count));
									//echo $rows;
									$select_rows = implode($indentifier, ", ");
									//echo $select_rows;
									while($i<=$rows) {
										$row = $db->fetchAll("SELECT ".$select_rows." FROM hrm_timesheet_hours_dates WHERE timesheet_id = ".$timesheet_id." AND order_id = ".$i.";");
										foreach ($row as $key => $value) {
										    //if ($key=="HUOMIOITA") {
											    //$this->Row(utf8_decode($value));
										    //} else {
										        //print_r($value);
										    	$this->Row($value);
										    //}
									    }
									    //var_dump($indentifier[$i]);
									    //echo $indentifier[$i];
										$i++;
									}
								   $i = 0;
									while($i<=0) {
										$rows = count($db->fetchAll($sql_count));
										$select_row = implode($indentifier, ", ");
										$row = $db->fetchAll("SELECT ".$select_row." FROM hrm_timesheet_hours_dates WHERE timesheet_id = ".$timesheet_id." AND order_id = ".$i.";");
										//$ii = 0;
										foreach ($row as $key => $value) {
											//print $key;
											//print_r($value);
											//if (isset($value[0])) {
											  $this->RowFooter($value,$timesheet_id);
											//} else {
											//print_r($value);
											  //$this->Row($value);
											//}
											//$ii++;
										}
										//var_dump($indentifier[$i]);
										//echo $indentifier[$i];
										$i++;
									}
									$this->ProcessingTable=false;
									$this->cMargin=$cMargin;
									$this->aCols=array();
	}
}