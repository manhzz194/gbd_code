<?php

namespace App\Http\Controllers\FrontEnd;

use App\Consts;
use App\Http\Services\ContentService;
use App\Models\Branch;
use App\Models\Contact;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $params['status'] = Consts::TAXONOMY_STATUS['active'];

        return $this->responseView('frontend.pages.contact.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'is_type' => 'required|max:255',
            'email' => 'required|email|max:255|unique:tb_contacts',
            'phone' => ['required', 'max:255', 'unique:tb_contacts', 'regex:#^(\+84|0)[3|5|7|8|9][0-9]{8}$#'],
        ], [
            'email.required' => 'Trường email là bắt buộc.',
            'email.email' => 'Trường email phải là một địa chỉ email hợp lệ.',
            'email.unique' => 'Trường email đã tồn tại.',
            'phone.required' => 'Trường số điện thoại là bắt buộc.',
            'phone.unique' => 'Trường số điện thoại đã tồn tại.',
            'phone.regex' => 'Số điện thoại không hợp lệ',
        ]);
        
        
        try {
            $params = $request->all();
            $link=$params['json_params']['template']!=""?$params['json_params']['template']."admin":"";
            $params['status'] = Consts::CONTACT_STATUS['new'];
            $messageResult = '';
            // Case get message
            switch ($params['is_type']) {
                case Consts::CONTACT_TYPE['newsletter']:
                    $messageResult = $this->web_information->information->notice_newsletter ?? __('Subscribe newsletter successfully!');
                    break;
                case Consts::CONTACT_TYPE['advise']:
                    $messageResult = $this->web_information->information->notice_advise ?? __('Booking successfull!');
                    break;
                case Consts::CONTACT_TYPE['faq']:
                    $messageResult = $this->web_information->information->notice_faq ?? __('Send contact successfully!');
                    break;
                case Consts::CONTACT_TYPE['call_request']:
                    $messageResult = $this->web_information->information->call_request ?? __('Gửi thành công ,Chúng tôi đã gửi thông tin đăng nhập đến email của bạn!');
                    break;
                default:
                    $messageResult = $this->web_information->information->notice_contact ?? __('Send contact successfully!');
                    break;
            }
            if ($params['is_type'] == Consts::CONTACT_TYPE['newsletter']) {
                $contact = Contact::firstOrCreate(
                    [
                        'is_type' => $params['is_type'],
                        'email' => $params['email']
                    ]
                );

                return $this->sendResponse($contact, $messageResult);
            } else {
                $contact = Contact::create($params);
                if ($params['is_type'] == Consts::CONTACT_TYPE['call_request'] ) {
                    if (isset($this->web_information->information->email)) {
                        $email = $this->web_information->information->email;
                        Mail::send('frontend.emails.contact', ['contact' => $contact], function ($message) use ($email) {
                            $message->to($email);
                            $message->subject(__('Bạn nhận 1 yêu cầu mới dùng thử templace trên hệ thống'));
                        }); 
                    }
                    if (isset($request->email)) {
                        $email = $request->email;
                        $data_send = [
                            'link' => $link,
                            'user' => 'test01@gmail.com',
                            'pass' => '12345678',
                        ];
                        Mail::send('frontend.emails.customer',$data_send, function ($message) use ($email) {
                            $message->to($email);
                            $message->subject(__('Thông tin đăng nhập'));
                        }); 
                    }
                }

                return $this->sendResponse($link, $messageResult);
            }
        } catch (Exception $ex) {
            // throw $ex;
            abort(422, __($ex->getMessage()));
        }
    }

    public function branch(Request $request)
    {
        $params['city'] = $request->get('city');
        $params['district'] = $request->get('district');

        $rows = Branch::where('status', Consts::STATUS['active'])
            ->when(!empty($params['city']), function ($query) use ($params) {
                $query->where('city', '=', $params['city']);
            })
            ->when(!empty($params['district']), function ($query) use ($params) {
                $query->where('district', '=', $params['district']);
            })
            ->get();

        $this->responseData['params'] = $params;
        $this->responseData['rows'] = $rows;

        return $this->responseView('frontend.pages.branch.index');
    }
}
