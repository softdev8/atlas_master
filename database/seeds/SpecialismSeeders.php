<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SpecialismSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specialisms = [
            /* Corporate and Commercial */
            [
                'title'         => 'Commercial Contracts',
                'area_id'       => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Corporate Finance',
                'area_id'       => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Corporate M&A',
                'area_id'       => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Equity Capital Markets',
                'area_id'       => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Competition',
                'area_id'       => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Financial Services',
                'area_id'       => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Partnerships',
                'area_id'       => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Tax',
                'area_id'       => 1,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],


            /* Crime, fraud and licensing */
            [
                'title'         => 'Crime: General',
                'area_id'       => 2,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Fraud: Civil',
                'area_id'       => 2,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Fraud: White Collar Crime',
                'area_id'       => 2,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Gaming and Betting',
                'area_id'       => 2,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Licensing',
                'area_id'       => 2,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],



            /* Dispute resolution */
            [
                'title'         => 'Banking Litigation',
                'area_id'       => 3,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Commercial Litigation',
                'area_id'       => 3,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Competition Litigation',
                'area_id'       => 3,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Debt Recovery',
                'area_id'       => 3,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Insolvency Litigation',
                'area_id'       => 3,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'International Arbitration',
                'area_id'       => 3,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Tax Litigation',
                'area_id'       => 3,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],

            /* Finance */
            [
                'title'         => 'Asset Finance',
                'area_id'       => 4,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Banking and Finance',
                'area_id'       => 4,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Commodities',
                'area_id'       => 4,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Corporate Restructuring / Insolvency',
                'area_id'       => 4,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Debt Capital Markets',
                'area_id'       => 4,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Derivatives and Structured Products',
                'area_id'       => 4,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Emerging Markets',
                'area_id'       => 4,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'High Yield',
                'area_id'       => 4,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Islamic Finance',
                'area_id'       => 4,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Securitisation',
                'area_id'       => 4,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Trade Finance',
                'area_id'       => 4,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],

            /* Human Resources */
            [
                'title'         => 'Employment',
                'area_id'       => 5,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Health and Safety',
                'area_id'       => 5,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Immigration',
                'area_id'       => 5,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Law Firm Management',
                'area_id'       => 5,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Pensions',
                'area_id'       => 5,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Share Schemes/ Executive Benefits',
                'area_id'       => 5,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],


            /* Insurance */
            [
                'title'         => 'Clinical Negligence',
                'area_id'       => 6,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Insurance',
                'area_id'       => 6,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Personal Injury',
                'area_id'       => 6,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Product Liability',
                'area_id'       => 6,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Professional Negligence',
                'area_id'       => 6,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],

            /* Investment fund */
            [
                'title'         => 'Funds',
                'area_id'       => 7,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],

            /* Private client */
            [
                'title'         => 'Agriculture and Estates',
                'area_id'       => 8,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Art and Cultural Property',
                'area_id'       => 8,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Charities',
                'area_id'       => 8,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Court of Protection',
                'area_id'       => 8,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Family',
                'area_id'       => 8,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Personal Tax, Trust and Probate',
                'area_id'       => 8,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Contentious Trusts and Probate',
                'area_id'       => 8,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],

            /* Projects, Energy and Natural Resources */
            [
                'title'         => 'Energy',
                'area_id'       => 9,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Mining and Minerals',
                'area_id'       => 9,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Project Finance and Infrastructure (PFI & PPP)',
                'area_id'       => 9,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Water',
                'area_id'       => 9,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],


            /* Public sector */
            [
                'title'         => 'Administrative and Public Law',
                'area_id'       => 10,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Civil Liberties and Human Rights',
                'area_id'       => 10,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Education',
                'area_id'       => 10,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Governmental',
                'area_id'       => 10,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Healthcare',
                'area_id'       => 10,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Mental Health',
                'area_id'       => 10,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],

            /* Real estate */
            [
                'title'         => 'Commercial Property',
                'area_id'       => 11,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Construction',
                'area_id'       => 11,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Environment',
                'area_id'       => 11,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Planning',
                'area_id'       => 11,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Property Finance',
                'area_id'       => 11,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Property Litigation',
                'area_id'       => 11,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Residential Property',
                'area_id'       => 11,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Social Housing',
                'area_id'       => 11,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],

            /* Risk Advisory */
            [
                'title'         => 'Brexit',
                'area_id'       => 12,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Corporate Governance',
                'area_id'       => 12,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Data Protection and Cybersecurity',
                'area_id'       => 12,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Regulatory Investigations and Corporate Crime',
                'area_id'       => 12,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Reputation Management/Defamation',
                'area_id'       => 12,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Risk and Compliance',
                'area_id'       => 12,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],

            /* TMT */
            [
                'title'         => 'Brand Management',
                'area_id'       => 13,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Fintech',
                'area_id'       => 13,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Franchising',
                'area_id'       => 13,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Intellectual Property',
                'area_id'       => 13,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'IT and Telecoms',
                'area_id'       => 13,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Media and Entertainment',
                'area_id'       => 13,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'PATMA: Patent Attorneys',
                'area_id'       => 13,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'PATMA: Trade Mark Attorneys',
                'area_id'       => 13,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Pharmaceuticals and Biotechnology',
                'area_id'       => 13,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Sports',
                'area_id'       => 13,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],

            /* Transport */
            [
                'title'         => 'Aviation',
                'area_id'       => 14,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Rail',
                'area_id'       => 14,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Shipping/ Marine',
                'area_id'       => 14,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
            [
                'title'         => 'Travel',
                'area_id'       => 14,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ],
        ];

        DB::table('filter_specialisms')->insert($specialisms);
    }
}