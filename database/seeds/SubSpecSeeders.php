<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SubSpecSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specialisms = [

            /* Commercial Contracts */
            [
                'title'         => 'Outsourcing',
                'specialism_id' => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Procurement',
                'specialism_id' => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],


            /* Corporate Finance */
            [
                'title'         => 'Flotations',
                'specialism_id' => 2,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Joint Ventures',
                'specialism_id' => 2,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Private Equity',
                'specialism_id' => 2,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Venture Capital',
                'specialism_id' => 2,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],



            /* Competition */
            [
                'title'         => 'EU and Competition',
                'specialism_id' => 5,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Customs and Excise',
                'specialism_id' => 5,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Trade, WTO Anti-Dumping and Customs',
                'specialism_id' => 5,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],



            /* Financial Services */
            [
                'title'         => 'Financial Services Contentious',
                'specialism_id' => 6,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Financial Services Regulatory',
                'specialism_id' => 6,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],


            /* Tax */
            [
                'title'         => 'Corporate Tax',
                'specialism_id' => 8,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'VAT and Indirect Tax',
                'specialism_id' => 8,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],



            /* Asset Finance */
            [
                'title'         => 'Aviation Finance',
                'specialism_id' => 21,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Ship/ Aviation/ Asset Finance',
                'specialism_id' => 21,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],


            /* Banking and Finance */
            [
                'title'         => 'Banking',
                'specialism_id' => 22,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Asset Based Lending',
                'specialism_id' => 22,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Acquisition Finance',
                'specialism_id' => 22,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Banking Lending',
                'specialism_id' => 22,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Leveraged Finance',
                'specialism_id' => 22,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],



            /* Commodities */
            [
                'title'         => 'Derivatives',
                'specialism_id' => 23,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Physicals',
                'specialism_id' => 23,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],



            /* Employment */
            [
                'title'         => 'Employment Advisory',
                'specialism_id' => 32,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Employment Contentious',
                'specialism_id' => 32,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],




            /* Clinical Negligence */
            [
                'title'         => 'Claimant',
                'specialism_id' => 38,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Defendant',
                'specialism_id' => 38,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],



            /* Insurance */
            [
                'title'         => 'Insurance and Reinsurance Litigation',
                'specialism_id' => 39,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Insurance Litigation: for Policyholders',
                'specialism_id' => 39,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Insurance: Corporate and Regulatory',
                'specialism_id' => 39,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],



            /* Personal Injury */
            [
                'title'         => 'Claimant',
                'specialism_id' => 40,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Defendant',
                'specialism_id' => 40,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],



            /* Product Liability */
            [
                'title'         => 'Claimant',
                'specialism_id' => 41,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Defendant',
                'specialism_id' => 41,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],



            /* Funds */
            [
                'title'         => 'Hedge funds',
                'specialism_id' => 43,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Listed funds',
                'specialism_id' => 43,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Private funds',
                'specialism_id' => 43,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Real estate funds',
                'specialism_id' => 43,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Retail funds',
                'specialism_id' => 43,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],




            /* Energy */
            [
                'title'         => 'Oil and Gas',
                'specialism_id' => 51,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Power (including electricity and renewables)',
                'specialism_id' => 51,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],



            /* Governmental */
            [
                'title'         => 'Electoral',
                'specialism_id' => 58,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Local Government',
                'specialism_id' => 58,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Infrastructure (Parliamentary)',
                'specialism_id' => 58,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],




            /* Commercial Property */
            [
                'title'         => 'Commercial Property',
                'specialism_id' => 61,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Development',
                'specialism_id' => 61,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],




            /* Construction */
            [
                'title'         => 'Construction Contentious',
                'specialism_id' => 62,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Construction Non-Contentious',
                'specialism_id' => 62,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],





            /* Social Housing */
            [
                'title'         => 'Finance',
                'specialism_id' => 68,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Local Authorities and Registered Providers',
                'specialism_id' => 68,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Tenant',
                'specialism_id' => 68,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],



            /* Intellectual Property */
            [
                'title'         => 'IP Commercial',
                'specialism_id' => 78,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'IP Litigation',
                'specialism_id' => 78,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],


            /* IT and Telecoms */
            [
                'title'         => 'Information Technology',
                'specialism_id' => 79,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Telecoms',
                'specialism_id' => 79,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
        ];

        DB::table('filter_sub_specialisms')->insert($specialisms);
    }
}
