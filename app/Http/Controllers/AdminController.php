<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Orders;
use App\Models\Products;
use App\Models\Categories;
use App\Models\CustomOrders;
use App\Models\OrderItems;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();
        $adminCount = User::where('role', 'admin')->count();
        $customerCount = User::where('role', 'customer')->count();
        $totalProducts = Products::count();
        $totalCategories = Categories::count();
        $totalOrders = Orders::count();
        $totalCustomOrders = CustomOrders::count();
        $totalRevenue = Orders::where('status', 'Paid')->sum('total_price');
        $orderStatusCount = [
            'pending' => Orders::where('status', 'Pending')->count(),
            'paid' => Orders::where('status', 'Paid')->count(),
            'canceled' => Orders::where('status', 'canceled')->count()
        ];
        $customOrderStatus = [
            'pending' => CustomOrders::where('status', 'pending')->count(),
            'reviewed' => CustomOrders::where('status', 'reviewed')->count(),
            'confirmed' => CustomOrders::where('status', 'confirmed')->count(),
            'rejected' => CustomOrders::where('status', 'rejected')->count()
        ];

        $pendingCustomOrders = $customOrderStatus['pending'];
        $paymentMethods = [
            'cod' => Orders::where('payment_method', 'cod')->count(),
            'transfer' => Orders::where('payment_method', 'transfer')->count()
        ];
        $topProducts = OrderItems::select('produk_id', DB::raw('SUM(kuantitas) as total_sold'))
            ->with('product')
            ->groupBy('produk_id')
            ->orderBy('total_sold', 'desc')
            ->limit(5)
            ->get();
        $userGrowth = [];
        for ($i = 30; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $userGrowth['labels'][] = now()->subDays($i)->format('d M');
            $userGrowth['data'][] = User::whereDate('created_at', $date)->count();
        }
        $monthlyRevenue = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $monthlyRevenue['labels'][] = $month->format('M Y');
            $monthlyRevenue['data'][] = Orders::where('status', 'Paid')
                ->whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->sum('total_price');
        }
        $recentOrders = Orders::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        $pendingCustomOrdersList = CustomOrders::with('product')
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        $lowStockProducts = Products::where('stock', '<', 10)
            ->orderBy('stock', 'asc')
            ->limit(5)
            ->get();
        $outOfStockProducts = Products::where('stock', 0)->count();
        return view('admin.dashboard', compact(
            'totalUsers',
            'adminCount',
            'customerCount',
            'totalProducts',
            'totalCategories',
            'totalOrders',
            'totalCustomOrders',
            'totalRevenue',
            'orderStatusCount',
            'customOrderStatus',
            'pendingCustomOrders',
            'paymentMethods',
            'topProducts',
            'userGrowth',
            'monthlyRevenue',
            'recentOrders',
            'pendingCustomOrdersList',
            'lowStockProducts',
            'outOfStockProducts'
        ));
    }
    public function indexCustomer()
    {
        $customer = User::where('role', 'customer')->paginate(5);
        return view('admin.users.index', compact('customer'));
    }
    public function destroyCustomer($id)
    {
        $pilih = User::findOrFail($id);
        $pilih->delete();
        return back()->with('success', 'Berhasil hapus customer '.$pilih->name);
    }
}
