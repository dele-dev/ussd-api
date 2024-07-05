<?php

function get789(){
    return [
        1 => [
             "" => "WELCOME TO CITSA.  ",
             1 => "1. Pay Due",
             2 => "2. Check Last 2 transactions ",
             0 => "0. Exit" 
             ],
        2 => [
            1 => [
                    1 => "1. Pay for One semester dues  ",
                    2 => "2. Pay for Two semesters dues  ",
                    3 => "3. Pay for Three semesters dues  ",
                    4 => "4. Pay for Four semesters dues  ",
                    5 => "5. Pay for Six semesters dues  ",
                    6 => "6. Pay for Eight semesters dues  ",
                    0 => "0. Exit"
                 ],
            2 => [
                    "paid" => [],
                    0 => "0. Exit"
            ],
            0 => [
                "" => "THANK YOU FOR USING CITSA-USSD!!.  "
            ]
                
            ],
        3 =>[
              1 => [
                    "" => "Pay for One semester dues for 10ghc  ",
                    1 => "1. Accept",
                    0 => "0. Exit"

              ],
              2 => [
                "" => "Pay for Two semesters dues for 20ghc  ",
                1 => "1. Accept",
                0 => "0. Exit"

              ],
              3 => [
                "" => "Pay for Three semesters dues for 30ghc  ", 
                1 => "1. Accept",
                0 => "0. Exit"

              ],
              4 => [
                "" => "Pay for Four semesters dues for 40ghc  ",
                1 => "1. Accept",
                0 => "0. Exit"

              ],
              5 => [
                "" => "Pay for Six semesters dues for 60ghc  ",
                1 => "1. Accept",
                0 => "0. Exit"

              ],
              6 => [
                "" => "Pay for Eight semesters dues for 80ghc  ",
                1 => "1. Accept",
                0 => "0. Exit"

              ],
              0 => [
                "" => "THANK YOU FOR USING CITSA-USSD!!.  "
                ]            
              ],
        4 => [
           1 => [
                1 => [
                    "" => "Dues of 10ghc payment made ... ",
                    0 => "0. Exit" 
                ],
                2 => [
                    "" => "Dues of 20ghc payment made ... ",
                    0 => "0. Exit" 
                ],
                3 => [
                    "" => "Dues of 30ghc payment made ... ",
                    0 => "0. Exit" 
                ],
                4 => [
                    "" => "Dues of 40ghc payment made ... ",
                    0 => "0. Exit" 
                ],
                5 => [
                    "" => "Dues of 60ghc payment made ... ",
                    0 => "0. Exit" 
                ],
                6 => [
                    "" => "Dues of 80ghc payment made ... ",
                    0 => "0. Exit" 
                ]   
            ],
          0 => [
            "" => "THANK YOU FOR USING CITSA-USSD!!.  "
            ]    
          ],
        5 =>[
            0 => [
                "" => "THANK YOU FOR USING CITSA-USSD!!.  "
            ],
            4 => [
                "" => "Confirm password!"
            ]  
          ],
        6 =>[
                4 => "Payment made successfully! THANK YOU FOR USING CITSA-USSD!!.  "
            ]
        ];
}

function operators () {
    return [
       "123" => "mtn",
       "231" => "Vodafone",
       "323" => "AirtelTigo",
       "321" => "Teledata",
    ];
}

function amountPaid () {
  return [
      "1"  => 10,
      "2"  => 20,
      "3"  => 30,
      "4"  => 40,
      "5"  => 60,
      "6"  => 80
  ];
}