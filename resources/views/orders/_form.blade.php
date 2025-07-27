
    <div style="padding: 20px; max-width: 800px; margin: 0 auto;">
        <!-- Header with Breadcrumb -->
        <div style="margin-bottom: 30px;">
            <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 12px; font-size: 14px; color: #6b7280;">
                <a href="{{ route('orders.index') }}" style="color: #8b5cf6; text-decoration: none; font-weight: 500;"
                    onmouseover="this.style.textDecoration='underline'"
                    onmouseout="this.style.textDecoration='none'">
                    Orders
                </a>
                <span>→</span>
                <span>{{ isset($order) ? 'Edit Order' : 'Create Order' }}</span>
            </div>
            <h2 style="font-size: 28px; font-weight: bold; color: #1f2937; margin: 0; display: flex; align-items: center; gap: 12px;">
                <span style="font-size: 32px;">{{ isset($order) ? '✏️' : '📋' }}</span>
                {{ isset($order) ? 'Edit Order' : 'Create Order' }}
            </h2>
            <p style="color: #6b7280; margin: 8px 0 0 0; font-size: 16px;">
                {{ isset($order) ? 'Update the order details below' : 'Fill in the details to place a new order' }}
            </p>
        </div>

        <!-- Form Container -->
        <div style="background: white; border-radius: 16px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07); border: 1px solid #e5e7eb; overflow: hidden;">
            <!-- Form Header -->
            <div style="background: {{ isset($order) ? 'linear-gradient(135deg, #fef3f2 0%, #fee2e2 100%)' : 'linear-gradient(135deg, #faf5ff 0%, #f3e8ff 100%)' }}; padding: 24px; border-bottom: 1px solid #e5e7eb;">
                <h3 style="margin: 0; font-size: 18px; font-weight: 600; color: {{ isset($order) ? '#dc2626' : '#8b5cf6' }}; display: flex; align-items: center; gap: 8px;">
                    <span>📦</span> Order Information
                </h3>
                <p style="margin: 8px 0 0 0; color: {{ isset($order) ? '#ef4444' : '#a855f7' }}; font-size: 14px;">
                    {{ isset($order) ? 'Modify the order details as needed' : 'Enter the product, quantity, and date for your order' }}
                </p>
            </div>

            <!-- Form Content -->
            <div style="padding: 32px;">
                <form method="POST" action="{{ isset($order) ? route('orders.update', $order) : route('orders.store') }}" style="display: flex; flex-direction: column; gap: 28px;">
                    @csrf
                    @if(isset($order))
                    @method('PUT')
                    @endif

                    <!-- Product Selection Field -->
                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <label for="product_id" style="font-weight: 600; color: #374151; font-size: 14px; display: flex; align-items: center; gap: 8px;">
                            <span style="color: #8b5cf6;">📦</span>
                            Product
                            <span style="color: #dc2626; font-size: 16px;">*</span>
                        </label>
                        <div style="position: relative;">
                            <select name="product_id"
                                id="product_id"
                                required
                                style="width: 100%; padding: 16px 20px; border: 2px solid {{ isset($order) ? '#ef4444' : '#8b5cf6' }}; border-radius: 12px; font-size: 16px; outline: none; transition: all 0.2s; background-color: white; cursor: pointer; appearance: none; background-image: url('data:image/svg+xml;utf8,<svg xmlns=\" http://www.w3.org/2000/svg\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"{{ isset($order) ? '%23ef4444' : '%238b5cf6' }}\">
                                <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M19 9l-7 7-7-7\" /></svg>'); background-repeat: no-repeat; background-position: right 16px center; background-size: 20px;"
                                onfocus="this.style.borderColor='{{ isset($order) ? '#ef4444' : '#8b5cf6' }}'; this.style.boxShadow='0 0 0 4px rgba({{ isset($order) ? '239, 68, 68' : '139, 92, 246' }}, 0.1)'"
                                onblur="this.style.borderColor='{{ isset($order) ? '#ef4444' : '#8b5cf6' }}'; this.style.boxShadow='none'">
                                <option value="" disabled {{ !isset($order) ? 'selected' : '' }} style="color: #9ca3af;">Select a product...</option>
                                @foreach($products as $product)
                                <option value="{{ $product->id }}" {{ (isset($order) && $order->product_id == $product->id) ? 'selected' : '' }}>
                                    {{ $product->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <p style="font-size: 13px; color: #6b7280; margin: 0;">
                            {{ isset($order) ? 'Current product: ' . $order->product->name : 'Choose the product you want to order' }}
                        </p>
                    </div>

                    <!-- Quantity Field -->
                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <label for="quantity" style="font-weight: 600; color: #374151; font-size: 14px; display: flex; align-items: center; gap: 8px;">
                            <span style="color: #8b5cf6;">📊</span>
                            Quantity
                            <span style="color: #dc2626; font-size: 16px;">*</span>
                        </label>
                        <div style="position: relative;">
                            <input type="number"
                                name="quantity"
                                id="quantity"
                                value="{{ $order->quantity ?? '' }}"
                                required
                                min="1"
                                placeholder="Enter quantity..."
                                style="width: 100%; padding: 16px 20px; border: 2px solid {{ isset($order) ? '#ef4444' : '#e5e7eb' }}; border-radius: 12px; font-size: 16px; outline: none; transition: all 0.2s; background-color: {{ isset($order) ? 'white' : '#fafafa' }};"
                                onfocus="this.style.borderColor='#8b5cf6'; this.style.boxShadow='0 0 0 4px rgba(139, 92, 246, 0.1)'; this.style.backgroundColor='white'"
                                onblur="this.style.borderColor='{{ isset($order) ? '#ef4444' : '#e5e7eb' }}'; this.style.boxShadow='none'; this.style.backgroundColor='{{ isset($order) ? 'white' : '#fafafa' }}'"
                                oninput="if(this.value > 0) { this.style.borderColor='#8b5cf6'; } else { this.style.borderColor='#e5e7eb'; }">
                        </div>
                        <p style="font-size: 13px; color: #6b7280; margin: 0;">
                            {{ isset($order) ? 'Current quantity: ' . number_format($order->quantity) : 'Enter the number of items to order' }}
                        </p>
                    </div>

                    <!-- Order Date Field -->
                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <label for="order_date" style="font-weight: 600; color: #374151; font-size: 14px; display: flex; align-items: center; gap: 8px;">
                            <span style="color: #8b5cf6;">📅</span>
                            Order Date
                            <span style="color: #dc2626; font-size: 16px;">*</span>
                        </label>
                        <div style="position: relative;">
                            <input type="date"
                                name="order_date"
                                id="order_date"
                                value="{{ isset($order) ? \Carbon\Carbon::parse($order->order_date)->format('Y-m-d') : '' }}"
                                required
                                style="width: 100%; padding: 16px 20px; border: 2px solid {{ isset($order) ? '#ef4444' : '#e5e7eb' }}; border-radius: 12px; font-size: 16px; outline: none; transition: all 0.2s; background-color: {{ isset($order) ? 'white' : '#fafafa' }}; cursor: pointer;"
                                onfocus="this.style.borderColor='#8b5cf6'; this.style.boxShadow='0 0 0 4px rgba(139, 92, 246, 0.1)'; this.style.backgroundColor='white'"
                                onblur="this.style.borderColor='{{ isset($order) ? '#ef4444' : '#e5e7eb' }}'; this.style.boxShadow='none'; this.style.backgroundColor='{{ isset($order) ? 'white' : '#fafafa' }}'"
                                onchange="this.style.borderColor='#8b5cf6'">
                        </div>
                        <p style="font-size: 13px; color: #6b7280; margin: 0;">
                            {{ isset($order) ? 'Current date: ' . \Carbon\Carbon::parse($order->order_date)->format('M d, Y') : 'Select when this order should be placed' }}
                        </p>
                    </div>

                    <!-- Action Buttons -->
                    <div style="display: flex; gap: 16px; margin-top: 24px; padding-top: 24px; border-top: 1px solid #f3f4f6;">
                        <button type="submit"
                            style="flex: 1; background: {{ isset($order) ? 'linear-gradient(135deg, #ef4444 0%, #dc2626 100%)' : 'linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%)' }}; color: white; padding: 16px 24px; border: none; border-radius: 12px; font-weight: 600; font-size: 16px; cursor: pointer; transition: all 0.2s; display: flex; align-items: center; justify-content: center; gap: 8px; box-shadow: 0 2px 4px rgba({{ isset($order) ? '239, 68, 68' : '139, 92, 246' }}, 0.2);"
                            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba({{ isset($order) ? '239, 68, 68' : '139, 92, 246' }}, 0.3)'"
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 4px rgba({{ isset($order) ? '239, 68, 68' : '139, 92, 246' }}, 0.2)'">
                            <span style="font-size: 18px;">{{ isset($order) ? '💾' : '🛒' }}</span>
                            {{ isset($order) ? 'Update Order' : 'Create Order' }}
                        </button>
                        <a href="{{ route('orders.index') }}"
                            style="flex: 1; background-color: #f8fafc; color: #374151; padding: 16px 24px; text-decoration: none; border-radius: 12px; font-weight: 600; font-size: 16px; transition: all 0.2s; display: flex; align-items: center; justify-content: center; gap: 8px; border: 2px solid #e5e7eb;"
                            onmouseover="this.style.backgroundColor='#f1f5f9'; this.style.borderColor='#d1d5db'; this.style.transform='translateY(-1px)'"
                            onmouseout="this.style.backgroundColor='#f8fafc'; this.style.borderColor='#e5e7eb'; this.style.transform='translateY(0)'">
                            <span style="font-size: 18px;">↩️</span>
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>

        @if(isset($order))
        <!-- Order Details Summary -->
        <div style="margin-top: 24px; background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%); border-radius: 12px; padding: 20px; border: 1px solid #0ea5e9;">
            <h4 style="margin: 0 0 16px 0; font-size: 16px; font-weight: 600; color: #0369a1; display: flex; align-items: center; gap: 8px;">
                <span>📊</span> Current Order Details
            </h4>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px;">
                <div>
                    <div style="font-size: 12px; color: #0369a1; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 4px;">Product</div>
                    <div style="font-weight: 600; color: #1e40af;">{{ $order->product->name }}</div>
                </div>
                <div>
                    <div style="font-size: 12px; color: #0369a1; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 4px;">Quantity</div>
                    <div style="font-weight: 600; color: #1e40af;">{{ number_format($order->quantity) }}</div>
                </div>
                <div>
                    <div style="font-size: 12px; color: #0369a1; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 4px;">Order Date</div>
                    <div style="font-weight: 600; color: #1e40af;">{{ \Carbon\Carbon::parse($order->order_date)->format('M d, Y') }}</div>
                </div>
                <div>
                    <div style="font-size: 12px; color: #0369a1; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 4px;">Last Updated</div>
                    <div style="font-weight: 600; color: #1e40af;">{{ $order->updated_at->format('M d, Y') }}</div>
                </div>
            </div>
        </div>
        @endif

        <!-- Help Section -->
        <div style="margin-top: 24px; background: linear-gradient(135deg, #fef7ff 0%, #faf5ff 100%); border-radius: 12px; padding: 20px; border: 1px solid #e9d5ff;">
            <h4 style="margin: 0 0 12px 0; font-size: 16px; font-weight: 600; color: #7c3aed; display: flex; align-items: center; gap: 8px;">
                <span>💡</span> {{ isset($order) ? 'Tips for Editing Orders' : 'Tips for Creating Orders' }}
            </h4>
            <ul style="margin: 0; padding-left: 20px; color: #6b46c1; line-height: 1.6;">
                @if(isset($order))
                <li style="margin-bottom: 8px;">Changes will be saved immediately after clicking "Update Order"</li>
                <li style="margin-bottom: 8px;">Make sure the quantity and date are accurate</li>
                <li style="margin-bottom: 8px;">Consider how changes might affect inventory planning</li>
                <li style="margin-bottom: 0;">You can view the current values in the summary section</li>
                @else
                <li style="margin-bottom: 8px;">Select the correct product before entering quantity</li>
                <li style="margin-bottom: 8px;">Quantity must be a positive number</li>
                <li style="margin-bottom: 8px;">Order date can be in the future for planned orders</li>
                <li style="margin-bottom: 0;">Double-check all details before submitting</li>
                @endif
            </ul>
        </div>

        <!-- Quick Stats -->
        <div style="margin-top: 24px; display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px;">
            <div style="background: white; border-radius: 12px; padding: 20px; border: 1px solid #e5e7eb; text-align: center;">
                <div style="font-size: 24px; font-weight: bold; color: #8b5cf6; margin-bottom: 4px;">
                    {{ count($products) }}
                </div>
                <div style="font-size: 14px; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em;">
                    Available Products
                </div>
            </div>
            <div style="background: white; border-radius: 12px; padding: 20px; border: 1px solid #e5e7eb; text-align: center;">
                <div style="font-size: 24px; font-weight: bold; color: {{ isset($order) ? '#ef4444' : '#3b82f6' }}; margin-bottom: 4px;">
                    {{ isset($order) ? 'Edit' : 'New' }}
                </div>
                <div style="font-size: 14px; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em;">
                    Order Status
                </div>
            </div>
        </div>
    </div>
