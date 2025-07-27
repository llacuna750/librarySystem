<x-app-layout>
    <div style="padding: 20px; max-width: 1200px; margin: 0 auto;">
        <!-- Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; flex-wrap: wrap; gap: 15px;">
            <h2 style="font-size: 24px; font-weight: bold; color: #1f2937; margin: 0;">Products</h2>
            <a href="{{ route('products.create') }}"
                style="background-color: #10b981; color: white; padding: 10px 20px; text-decoration: none; border-radius: 8px; font-weight: 500; display: inline-flex; align-items: center; gap: 8px; transition: background-color 0.2s;"
                onmouseover="this.style.backgroundColor='#059669'"
                onmouseout="this.style.backgroundColor='#10b981'">
                <span style="font-size: 18px;">+</span> Create Product
            </a>
        </div>

        <!-- Search Form -->
        <div style="margin-bottom: 30px;">
            <form method="GET" style="display: flex; gap: 15px; flex-wrap: wrap;">
                <div style="flex: 1; min-width: 250px; position: relative;">
                    <span style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #6b7280; font-size: 16px;">🔍</span>
                    <input type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search products..."
                        style="width: 100%; padding: 12px 16px 12px 40px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; outline: none; background-color: white;"
                        onfocus="this.style.borderColor='#10b981'; this.style.boxShadow='0 0 0 3px rgba(16, 185, 129, 0.1)'"
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
                <table style="width: 100%; border-collapse: collapse; min-width: 600px;">
                    <thead>
                        <tr style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);">
                            <th style="padding: 18px 20px; text-align: left; font-weight: 600; color: #374151; border-bottom: 2px solid #e5e7eb; font-size: 13px; text-transform: uppercase; letter-spacing: 0.05em;">
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <span>📦</span> Product Name
                                </div>
                            </th>
                            <th style="padding: 18px 20px; text-align: left; font-weight: 600; color: #374151; border-bottom: 2px solid #e5e7eb; font-size: 13px; text-transform: uppercase; letter-spacing: 0.05em;">
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <span>🏢</span> Supplier
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
                        @forelse ($products as $product)
                        <tr style="border-bottom: 1px solid #f3f4f6; transition: background-color 0.2s;"
                            onmouseover="this.style.backgroundColor='#f9fafb'"
                            onmouseout="this.style.backgroundColor='white'">
                            <td style="padding: 16px 20px;">
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    <div style="width: 8px; height: 8px; background-color: #10b981; border-radius: 50%; flex-shrink: 0;"></div>
                                    <span style="color: #1f2937; font-weight: 500; font-size: 15px;">{{ $product->name }}</span>
                                </div>
                            </td>
                            <td style="padding: 16px 20px;">
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <div style="background-color: #f3f4f6; color: #6b7280; padding: 4px 8px; border-radius: 12px; font-size: 12px; font-weight: 500;">
                                        {{ $product->supplier->name }}
                                    </div>
                                </div>
                            </td>
                            <td style="padding: 16px 20px;">
                                <div style="display: flex; gap: 8px;">
                                    <a href="{{ route('products.edit', $product->id) }}"
                                        style="background-color: #dbeafe; color: #1e40af; padding: 8px 16px; text-decoration: none; border-radius: 20px; font-size: 13px; font-weight: 500; display: inline-flex; align-items: center; gap: 6px; transition: all 0.2s; border: 1px solid transparent;"
                                        onmouseover="this.style.backgroundColor='#bfdbfe'; this.style.transform='translateY(-1px)'; this.style.boxShadow='0 2px 4px rgba(30, 64, 175, 0.2)'"
                                        onmouseout="this.style.backgroundColor='#dbeafe'; this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                                        <span>✏️</span> Edit
                                    </a>
                                    <!-- You can add more action buttons here -->
                                    <!-- 
                                <a href="#" 
                                   style="background-color: #fef2f2; color: #dc2626; padding: 8px 16px; text-decoration: none; border-radius: 20px; font-size: 13px; font-weight: 500; display: inline-flex; align-items: center; gap: 6px; transition: all 0.2s;"
                                   onmouseover="this.style.backgroundColor='#fee2e2'; this.style.transform='translateY(-1px)'" 
                                   onmouseout="this.style.backgroundColor='#fef2f2'; this.style.transform='translateY(0)'">
                                    <span>🗑️</span> Delete
                                </a>
                                -->
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" style="padding: 60px 20px; text-align: center; color: #6b7280;">
                                <div style="display: flex; flex-direction: column; align-items: center; gap: 16px;">
                                    <div style="font-size: 64px; opacity: 0.5;">📦</div>
                                    <div>
                                        <p style="font-size: 18px; font-weight: 600; margin: 0 0 8px 0; color: #374151;">No products found</p>
                                        <p style="font-size: 14px; color: #9ca3af; margin: 0;">Start by creating your first product or try adjusting your search.</p>
                                    </div>
                                    <a href="{{ route('products.create') }}"
                                        style="background-color: #10b981; color: white; padding: 10px 20px; text-decoration: none; border-radius: 8px; font-weight: 500; margin-top: 8px; transition: background-color 0.2s;"
                                        onmouseover="this.style.backgroundColor='#059669'"
                                        onmouseout="this.style.backgroundColor='#10b981'">
                                        Create First Product
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
        @if($products->hasPages())
        <div style="margin-top: 30px; display: flex; justify-content: center;">
            <div style="background: white; border-radius: 8px; padding: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                {{ $products->links() }}
            </div>
        </div>
        @endif

        <!-- Stats Footer (Optional) -->
        <div style="margin-top: 30px; display: flex; justify-content: center; gap: 20px; flex-wrap: wrap;">
            <div style="background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%); padding: 16px 24px; border-radius: 12px; text-align: center; border: 1px solid #e0f2fe;">
                <div style="font-size: 24px; font-weight: bold; color: #0284c7;">{{ $products->total() }}</div>
                <div style="font-size: 12px; color: #0369a1; text-transform: uppercase; letter-spacing: 0.05em;">Total Products</div>
            </div>
            @if(request('search'))
            <div style="background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%); padding: 16px 24px; border-radius: 12px; text-align: center; border: 1px solid #dcfce7;">
                <div style="font-size: 24px; font-weight: bold; color: #16a34a;">{{ $products->count() }}</div>
                <div style="font-size: 12px; color: #15803d; text-transform: uppercase; letter-spacing: 0.05em;">Search Results</div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>