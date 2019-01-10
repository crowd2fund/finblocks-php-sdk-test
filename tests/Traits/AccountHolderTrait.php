<?php

namespace FinBlocks\Tests\Traits;

use FinBlocks\FinBlocks;
use FinBlocks\Model\AccountHolder\AccountHolderBusiness;
use FinBlocks\Model\AccountHolder\AccountHolderIndividual;
use FinBlocks\Model\AccountHolder\Company\Company;

trait AccountHolderTrait
{
    public function traitCreateAccountHolderIndividualModel(FinBlocks $finBlocks): AccountHolderIndividual
    {
        $model = $finBlocks->factories()->accountHolders()->createIndividual();

        $model->setEmail('individual@johnpublic.com');
        $model->setLabel('John Q. Public');
        $model->setTag('Individual Test User');
        $model->setGivenName('John');
        $model->setMiddleName('Q.');
        $model->setFamilyName('Public');
        $model->setDateOfBirth(\DateTime::createFromFormat('Y-m-d', '1985-04-23'));
        $model->setNationality('GBR');
        $model->setOccupation('Unknown');
        $model->setIncomeRange(6);
        $model->getAddress()->setFlatNumber('3');
        $model->getAddress()->setBuildingNumber('28');
        $model->getAddress()->setBuildingName('n/a');
        $model->getAddress()->setStreet('Ely Place');
        $model->getAddress()->setSubStreet('N/A');
        $model->getAddress()->setTown('London');
        $model->getAddress()->setState('England');
        $model->getAddress()->setPostcode('EC1N 6TD');
        $model->getAddress()->setCountry('GBR');

        return $model;
    }

    public function traitCreateAccountHolderBusinessModel(FinBlocks $finBlocks): AccountHolderBusiness
    {
        $model = $finBlocks->factories()->accountHolders()->createBusiness();
        $model->setEmail('business@johnpublic.com');
        $model->setLabel('John Q. Public');
        $model->setTag('Business Test User');
        $model->setGivenName('John');
        $model->setMiddleName('Q.');
        $model->setFamilyName('Public');
        $model->setDateOfBirth(\DateTime::createFromFormat('Y-m-d', '1985-04-23'));
        $model->setNationality('GBR');
        $model->setOccupation('CEO');
        $model->setIncomeRange(6);
        $model->getAddress()->setFlatNumber('3');
        $model->getAddress()->setBuildingNumber('28');
        $model->getAddress()->setBuildingName('n/a');
        $model->getAddress()->setStreet('Ely Place');
        $model->getAddress()->setSubStreet('N/A');
        $model->getAddress()->setTown('London');
        $model->getAddress()->setState('England');
        $model->getAddress()->setPostcode('EC1N 6TD');
        $model->getAddress()->setCountry('GBR');
        $model->getCompany()->setEmail('info@johnpublic.com');
        $model->getCompany()->setName('John Q. Public LTD');
        $model->getCompany()->setNumber('0000000000');
        $model->getCompany()->setType(Company::TYPE_BUSINESS);
        $model->getCompany()->getAddress()->setFlatNumber('3');
        $model->getCompany()->getAddress()->setBuildingNumber('28');
        $model->getCompany()->getAddress()->setBuildingName('n/a');
        $model->getCompany()->getAddress()->setStreet('Ely Place');
        $model->getCompany()->getAddress()->setSubStreet('N/A');
        $model->getCompany()->getAddress()->setTown('London');
        $model->getCompany()->getAddress()->setState('England');
        $model->getCompany()->getAddress()->setPostcode('EC1N 6TD');
        $model->getCompany()->getAddress()->setCountry('GBR');

        return $model;
    }
}
