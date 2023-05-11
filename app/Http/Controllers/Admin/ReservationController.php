<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\NotificationTrait;
use App\Http\Traits\SendEmail;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use App\Models\Notification;

class ReservationController extends Controller
{
     use NotificationTrait;
    use SendEmail;

    public function reservationStatus($reservation_status)
    {
        if ($reservation_status === 'ended') {
            $status = 'منتهى';
            $color = 'success';
        }elseif ($reservation_status === 'accepted') {
            $status = 'مقبول';
            $color = 'primary';
        }elseif ($reservation_status === 'refused') {
            $status = 'مرفوض';
            $color = 'danger';
        }elseif ($reservation_status === 'canceled') {
            $status = 'ملغى';
            $color = 'warning';
        } else {
            $status = 'جديد';
            $color = 'info';
        }

        return ['status' => $status, 'color' => $color];
    }

//#################################################################
    public function index(Request $request )
    {
        if ($request->ajax()) {
            $reservation_from = $request->reservation_from ? date('Y-m-d', strtotime($request->reservation_from)) : date('1970-1-1');
            $reservation_to = $request->reservation_to ? date('Y-m-d', strtotime($request->reservation_to)) : date('Y-m-d', strtotime('+1 year'));
            $status = $request->status != null ? [$request->status] : [ 'new', 'accepted', 'refused', 'canceled', 'ended'];
            $status = $request->status == 'all' ? [ 'new', 'accepted', 'refused', 'canceled', 'ended'] : $status;
            if ($request->user_id){
                $reservations = Reservation::where(['user_id'=>$request->user_id])
                    ->whereIn('status', $status)
//                    ->with('brand.sub_category.category','user')
                    ->whereBetween('created_at', [$reservation_from, $reservation_to])
                    ->orderBy('created_at', 'desc')->get();
            }else{
                $reservations = Reservation::whereHas('user')
                    ->whereIn('status', $status)
//                    ->with('brand.sub_category.category','user')
                    ->whereBetween('created_at', [$reservation_from, $reservation_to])
                    ->orderBy('created_at', 'desc')->get();
            }
//            return $reservations;
            return Datatables::of($reservations)
                ->addColumn('action', function ($reservation) {
                    if (in_array(40, admin()->user()->permission_ids)) {
                        return '
                            <button class="btn btn-default btn-danger btn-sm mb-2 mb-xl-0 delete"
                                 data-id="' . $reservation->id . '" ><i class="fa fa-trash-o text-white"></i>
                            </button>
                       ';
                    }

                })
                ->editColumn('status', function ($reservation) {
                    $reservation_status = $this->reservationStatus($reservation->status);
                    $statusBtn = in_array(41, admin()->user()->permission_ids) ? "statusBtn" : " ";
                    $button = '<div class="card-options pr-0">
                                    <a class="btn btn-sm ' . $statusBtn . '" style="background-color: #0ea5b9;color: white" href="' . route("change_reservation_status", $reservation->id) . '"><i class="fa fa-pencil mb-0"></i></a>
                                </div>';
                    return '
                            <div class="card-header pt-0  pb-0 border-bottom-0">
                            <a  class="badge badge-' . $reservation_status['color'] . ' text-white ">' . $reservation_status['status'] . '</a>
                                ' . $button . '
                            </div>
							';
                })
                ->editColumn('created_at', function ($reservation) {
                    return date('d-m-Y', strtotime($reservation->created_at)) ;
                })
                ->editColumn('date', function ($reservation) {
                    return date('d-m-Y', strtotime($reservation->date)) ;
                })
                ->addColumn('details', function ($reservation) {
                    return '<div class="card-options pr-2">
                                    <a class="btn btn-sm btn-primary text-white statusBtn"  href="' . route("reservation_details", $reservation->id) . '"><i class="fa fa-book mb-0"></i></a>
                           </div>';
                })
                ->addColumn('user', function ($reservation) {
                    return $reservation->user ?$reservation->user->name: '';
                })
                ->addColumn('doctor', function ($reservation) {
                    return $reservation->doctor ?$reservation->doctor->name: '';
                })
                ->addColumn('hospital', function ($reservation) {
                    return $reservation->hospital ?$reservation->hospital->name: '';
                })
                ->addColumn('gender', function ($reservation) {
                    return $reservation->gender=='male' ?'ذكر': 'انثى';
                })
                ->editColumn('image',function ($slider){
                    return '<img alt="image" class="img list-thumbnail border-0" style="width:100px;border-radius:10px" onclick="window.open(this.src)" src="'.$slider->image.'">';
                })
                ->addColumn('checkbox', function ($reservation) {
                    return '<input type="checkbox" class="sub_chk" data-id="' . $reservation->id . '">';
                })
                ->escapeColumns([])
                ->make(true);
        }

        return view('Admin.Reservation.index');
    }

//#################################################################

    ################ multiple Delete  #################
    public function multiDelete(Request $request)
    {
        $ids = explode(",", $request->ids);
        Reservation::whereIn('id', $ids)->delete();

        return response()->json(
            [
                'code' => 200,
                'message' => 'تم الحذف بنجاح'
            ]);
    }


    ################ Delete Reservation #################
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return response()->json(
            [
                'code' => 200,
                'message' => 'تم الحذف بنجاح'
            ]);
    }

    ################ change_reservation_status #################
    public function change_reservation_status($id)
    {
        $reservation = reservation::where('id', $id)->select('id','status')->first();
        return view('Admin.reservation.parts.status', compact('reservation'))->render();
    }

    ################ change_reservation_status #################
    public function update_reservation_status(Request $request)
    {
        $reservation = reservation::where('id', $request->id)->with('user')->first();
        $reservation->update(['status' => $request->status]);

        return response()->json(
            [
                'success' => 'true',
                'message' => 'تم تغيير الحالة بنجاح '
            ]);
    }

    ##############################################
    ################ reservation_details #################
    public function reservation_details($id)
    {
        $reservation = Reservation::with('details')->where('id', $id)->first();
        return view('Admin.Reservation.parts.details', compact('reservation'))->render();
    }
}
