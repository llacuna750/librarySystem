<x-app-layout>
    <div style="padding: 20px; max-width: 1200px; margin: 0 auto;">
        <!-- Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; flex-wrap: wrap; gap: 15px;">
            <h2 style="font-size: 24px; font-weight: bold; color: #1f2937; margin: 0;">Orders</h2>
            <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                <a href="{{ route('orders.create') }}" 
                   style="background-color: #8b5cf6; color: white; padding: 10px 20px; text-decoration: none; border-radius: 8px; font-weight: 500; display: inline-flex; align-items: center; gap: 8px; transition: background-color 0.2s;"
                   onmouseover="this.style.backgroundColor='#7c3aed'" 
                   onmouseout="this.style.backgroundColor='#8b5cf6'">
                    <span style="font-size: 18px;">+</span> Create Order
                </a>
                <a href="{{ route('orders.pdf') }}" 
                   style="background-color: #dc2626; color: white; padding: 10px 20px; text-decoration: none; border-radius: 8px; font-weight: 500; display: inline-flex; align-items: center; gap: 8px; transition: background-color 0.2s;"
                   onmouseover="this.style.backgroundColor='#b91c1c'" 
                   onmouseout="this.style.backgroundColor='#dc2626'">
                    <span>📄</span> Download PDF
                </a>
            </div>
        </div>

        <!-- Search Form -->
        <div style="margin-bottom: 30px;">
            <form method="GET" style="display: flex; gap: 15px; flex-wrap: wrap;">
                <div style="flex: 1; min-width: 250px; position: relative;">
                    <span style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #6b7280; font-size: 16px;">🔍</span>
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}" 
                           placeholder="Search orders by product name..."
                           style="width: 100%; padding: 12px 16px 12px 40px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; outline: none; background-color: white;"
                           onfocus="this.style.borderColor='#8b5cf6'; this.style.boxShadow='0 0 0 3px rgba(139, 92, 246, 0.1)'"
                           onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none'">
                </div>
                <button type="submit" 
                        style="background-color: #374151; color: white; padding: 12px 24px; border: none; border-radius: 8px; font-weight: 500; cursor: pointer; transition: background-color 0.2s; display: flex; align-items: center; gap: 8px;"
                        onmouseover="this.style.backgroundColor='#1f2937'" 
                        onmouseout="this.style.backgroundColor='#374151'">
                    <span>🔍</span> Search
                </button>
            </form>
        </div>

        <!-- Table Container -->
        <div style="background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07); border: 1px solid #e5e7eb;">
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; min-width: 700px;">
                    <thead>
                        <tr style="background: linear-gradient(135deg, #faf5ff 0%, #f3e8ff 100%);">
                            <th style="padding: 18px 20px; text-align: left; font-weight: 600; color: #374151; border-bottom: 2px solid #e5e7eb; font-size: 13px; text-transform: uppercase; letter-spacing: 0.05em;">
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <span>📦</span> Product
                                </div>
                            </th>
                            <th style="padding: 18px 20px; text-align: left; font-weight: 600; color: #374151; border-bottom: 2px solid #e5e7eb; font-size: 13px; text-transform: uppercase; letter-spacing: 0.05em;">
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <span>📊</span> Quantity
                                </div>
                            </th>
                            <th style="padding: 18px 20px; text-align: left; font-weight: 600; color: #374151; border-bottom: 2px solid #e5e7eb; font-size: 13px; text-transform: uppercase; letter-spacing: 0.05em;">
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <span>📅</span> Order Date
                                </div>
                            </th>
                            <th style="padding: 18px 20px; text-align: left; font-weight: 600; color: #374151; border-bottom: 2px solid #e5e7eb; font-size: 13px; text-transform: uppercase; letter-spacing: 0.05em;">
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <span>⚙️</span> Actions
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                        <tr style="border-bottom: 1px solid #f3f4f6; transition: background-color 0.2s;" 
                            onmouseover="this.style.backgroundColor='#f9fafb'" 
                            onmouseout="this.style.backgroundColor='white'">
                            <td style="padding: 16px 20px;">
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    <div style="width: 8px; height: 8px; background-color: #8b5cf6; border-radius: 50%; flex-shrink: 0;"></div>
                                    <span style="color: #1f2937; font-weight: 500; font-size: 15px;">{{ $order->product->name }}</span>
                                </div>
                            </td>
                            <td style="padding: 16px 20px;">
                                <div style="display: inline-flex; align-items: center; gap: 8px; background-color: #f0f9ff; color: #0369a1; padding: 6px 12px; border-radius: 16px; font-weight: 600; font-size: 14px;">
                                    <span style="font-size: 12px;">📈</span>
                                    {{ number_format($order->quantity) }}
                                </div>
                            </td>
                            <td style="padding: 16px 20px;">
                                <div style="color: #374151; font-weight: 500;">
                                    {{ \Carbon\Carbon::parse($order->order_date)->format('M d, Y') }}
                                </div>
                                <div style="color: #6b7280; font-size: 12px; margin-top: 2px;">
                                    {{ \Carbon\Carbon::parse($order->order_date)->diffForHumans() }}
                                </div>
                            </td>
                            <td style="padding: 16px 20px;">
                                <div style="display: flex; gap: 8px;">
                                    <a href="{{ route('orders.edit', $order->id) }}" 
                                       style="background-color: #dbeafe; color: #1e40af; padding: 8px 16px; text-decoration: none; border-radius: 20px; font-size: 13px; font-weight: 500; display: inline-flex; align-items: center; gap: 6px; transition: all 0.2s; border: 1px solid transparent;"
                                       onmouseover="this.style.backgroundColor='#bfdbfe'; this.style.transform='translateY(-1px)'; this.style.boxShadow='0 2px 4px rgba(30, 64, 175, 0.2)'" 
                                       onmouseout="this.style.backgroundColor='#dbeafe'; this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                                        <span>✏️</span> Edit
                                    </a>
                                    <!-- Optional: Add view or delete actions -->
                                    <!-- 
                                    <a href="#" 
                                       style="background-color: #f0fdf4; color: #16a34a; padding: 8px 16px; text-decoration: none; border-radius: 20px; font-size: 13px; font-weight: 500; display: inline-flex; align-items: center; gap: 6px; transition: all 0.2s;"
                                       onmouseover="this.style.backgroundColor='#dcfce7'; this.style.transform='translateY(-1px)'" 
                                       onmouseout="this.style.backgroundColor='#f0fdf4'; this.style.transform='translateY(0)'">
                                        <span>👁️</span> View
                                    </a>
                                    -->
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="padding: 60px 20px; text-align: center; color: #6b7280;">
                                <div style="display: flex; flex-direction: column; align-items: center; gap: 16px;">
                                    <div style="font-size: 64px; opacity: 0.5;">📋</div>
                                    <div>
                                        <p style="font-size: 18px; font-weight: 600; margin: 0 0 8px 0; color: #374151;">No orders found</p>
                                        <p style="font-size: 14px; color: #9ca3af; margin: 0;">Start by creating your first order or try adjusting your search.</p>
                                    </div>
                                    <a href="{{ route('orders.create') }}" 
                                       style="background-color: #8b5cf6; color: white; padding: 10px 20px; text-decoration: none; border-radius: 8px; font-weight: 500; margin-top: 8px; transition: background-color 0.2s;"
                                       onmouseover="this.style.backgroundColor='#7c3aed'" 
                                       onmouseout="this.style.backgroundColor='#8b5cf6'">
                                        Create First Order
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if($orders->hasPages())
        <div style="margin-top: 30px; display: flex; justify-content: center;">
            <div style="background: white; border-radius: 8px; padding: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                {{ $orders->links() }}
            </div>
        </div>
        @endif

        <!-- Stats Footer -->
        <div style="margin-top: 30px; display: flex; justify-content: center; gap: 20px; flex-wrap: wrap;">
            <div style="background: linear-gradient(135deg, #fef3f2 0%, #fee2e2 100%); padding: 16px 24px; border-radius: 12px; text-align: center; border: 1px solid #fecaca;">
                <div style="font-size: 24px; font-weight: bold; color: #dc2626;">{{ $orders->total() }}</div>
                <div style="font-size: 12px; color: #991b1b; text-transform: uppercase; letter-spacing: 0.05em;">Total Orders</div>
            </div>
            @if(request('search'))
            <div style="background: linear-gradient(135deg, #f0f9ff 0%, #dbeafe 100%); padding: 16px 24px; border-radius: 12px; text-align: center; border: 1px solid #bfdbfe;">
                <div style="font-size: 24px; font-weight: bold; color: #2563eb;">{{ $orders->count() }}</div>
                <div style="font-size: 12px; color: #1d4ed8; text-transform: uppercase; letter-spacing: 0.05em;">Search Results</div>
            </div>
            @endif
            <div style="background: linear-gradient(135deg, #faf5ff 0%, #f3e8ff 100%); padding: 16px 24px; border-radius: 12px; text-align: center; border: 1px solid #e9d5ff;">
                <div style="font-size: 24px; font-weight: bold; color: #8b5cf6;">
                    {{ $orders->sum('quantity') }}
                </div>
                <div style="font-size: 12px; color: #7c3aed; text-transform: uppercase; letter-spacing: 0.05em;">Total Quantity</div>
            </div>
        </div>

        <!-- Quick Actions Footer -->
        <div style="margin-top: 30px; padding: 20px; background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); border-radius: 12px; border: 1px solid #e2e8f0;">
            <h3 style="margin: 0 0 16px 0; font-size: 16px; font-weight: 600; color: #374151; display: flex; align-items: center; gap: 8px;">
                <span>⚡</span> Quick Actions
            </h3>
            <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                <a href="{{ route('orders.create') }}" 
                   style="background-color: white; color: #8b5cf6; padding: 8px 16px; text-decoration: none; border-radius: 8px; font-weight: 500; border: 1px solid #e5e7eb; transition: all 0.2s; font-size: 14px;"
                   onmouseover="this.style.backgroundColor='#8b5cf6'; this.style.color='white'; this.style.transform='translateY(-1px)'" 
                   onmouseout="this.style.backgroundColor='white'; this.style.color='#8b5cf6'; this.style.transform='translateY(0)'">
                    📝 New Order
                </a>
                <a href="{{ route('orders.pdf') }}" 
                   style="background-color: white; color: #dc2626; padding: 8px 16px; text-decoration: none; border-radius: 8px; font-weight: 500; border: 1px solid #e5e7eb; transition: all 0.2s; font-size: 14px;"
                   onmouseover="this.style.backgroundColor='#dc2626'; this.style.color='white'; this.style.transform='translateY(-1px)'" 
                   onmouseout="this.style.backgroundColor='white'; this.style.color='#dc2626'; this.style.transform='translateY(0)'">
                    📊 Export Report
                </a>
                <!-- Add more quick actions as needed -->
            </div>
        </div>
    </div>
</x-app-layout>