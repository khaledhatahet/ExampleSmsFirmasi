<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Message;
use App\Http\Traits\GeneralTrait;
use App\Http\Resources\MessageResource;
use App\Http\Requests\StoremessageRequest;

class MessageController extends Controller
{
    use GeneralTrait;

    /**
     * @OA\Get(
     *     path="/api/messages",
     *     summary="Get a list of Messages",
     *     tags={"Messages"},
     * @OA\Response(
     *         response="200",
     *         description="The data"
     *     )
     * )
     */

    public function index()
    {
        try{
            $messages = Message::get();
            $messages = MessageResource::collection($messages);
            return $this->returnData("data", $messages);

        }catch(\Throwable $th){
            return $this->returnError($th->getMessage());
        }
    }

    /**
     * @OA\Post(
     *     path="/api/messages",
     *     summary="Add new Message",
     *     tags={"Messages"},
     *  @OA\Parameter(
     *    name="number",
     *         description="User Phone Number",
     *         in="query",
     *         required=true,
     *         example="00905385497592"
     *     ),
     *  @OA\Parameter(
     *         name="message",
     *         description="Message to sent to user",
     *         in="query",
     *         required=true,
     *         example="Hello, Thank you"
     *     ),
     *  @OA\Parameter(
     *         name="sender_id",
     *         description="Sender User Id",
     *         in="query",
     *         required=true,
     *         example="1"
     *     ),
     * @OA\Response(
     *         response="200",
     *         description="data added successfully"
     *     )
     * )
     */

    public function store(StoremessageRequest $request)
    {
        try{
            $create = Message::create([
                'number' => $request->number,
                'message' => $request->message,
                'send_time' => Carbon::now()->toDateTimeString(),
                'sender_id' => $request->sender_id,
            ]);

            if(! $create){
                return $this->returnError(__('general.ErrorWhenAddingData'));
            }
            return $this->returnSuccessMessage(__('general.AddedSuccessfully'));

        }catch(\Throwable $th){
            return $this->returnError($th->getMessage());
        }
    }

     /**
     * @OA\Get(
     *     path="/api/messages/{message}",
     *     summary="Show One Message",
     *     tags={"Messages"},
     *  @OA\Parameter(
     *         name="message",
     *         description="Message Id",
     *         in="path",
     *         required=true,
     *         example="1"
     *     ),
     * @OA\Response(
     *         response="200",
     *         description="The data"
     *     )
     * )
     */

    public function show(Message $message)
    {
        try{
            $messaage = new MessageResource($message);
            return $this->returnData("data", $messaage);
        }catch(\Throwable $th){
            return $this->returnError($th->getMessage());
        }
    }

      /**
     * @OA\Get(
     *     path="/api/fliterMessagesByDate/{date}",
     *     summary="Filter Messages By Date",
     *     tags={"Messages"},
     *  @OA\Parameter(
     *         name="date",
     *         description="Message Send Date",
     *         in="path",
     *         required=true,
     *         example="2024-01-11"
     *     ),
     * @OA\Response(
     *         response="200",
     *         description="The data"
     *     )
     * )
     */

    public function filterMessagesByDate($date){
        try{

           $messages = Message::whereDate('send_time',$date)->get();
           $messages = MessageResource::collection($messages);
           return $this->returnData("data", $messages);

        }catch(\Throwable $th){
            return $this->returnError($th->getMessage());
        }
    }

}
