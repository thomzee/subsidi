<?php


namespace App\Mappers;


use App\Services\Mapper\BaseMapper;
use App\Services\Mapper\MapperContract;

class MemberMapper extends BaseMapper implements MapperContract
{
    /**
     * Map single object to desired result.
     *
     * @param $item
     * @return array|mixed
     */
    function single($item)
    {
        return [
            'name' => $item->name,
            'email' => $item->email,
            'phone' => $item->phone,
            'address' => $item->address,

            'type' => $item->type,
            'partner_type' => $item->partner_type,
            'partner_license' => $item->partner_license,
            'company' => $item->company,
            'company_license' => $item->company_license,

            'headline' => $item->headline,
            'education' => $item->education,
            'experience' => $item->experience,
            'certification' => $item->certification,
            'categories' => $item->categories,

            'requested_at' => $item->requested_at ? $item->requested_at : '',
            'approved_at' => $item->approved_at ? $item->approved_at : '',
            'approval_status' => $item->approval_status ? $item->approval_status : '',
        ];
    }

    /**
     * Mapper for data create response.
     *
     * @param $item
     * @return mixed
     */
    function create($item)
    {
        // TODO: Implement create() method.
    }

    /**
     * Mapper for data edit response.
     *
     * @param $item
     * @return mixed
     */
    function edit($item)
    {
        // TODO: Implement edit() method.
    }
}
