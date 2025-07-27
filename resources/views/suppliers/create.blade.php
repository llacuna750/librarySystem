<x-app-layout>
    <div style="padding: 20px; max-width: 800px; margin: 0 auto;">
        <!-- Header with Breadcrumb -->
        <div style="margin-bottom: 30px;">
            <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 12px; font-size: 14px; color: #6b7280;">
                <a href="{{ route('suppliers.index') }}" style="color: #3b82f6; text-decoration: none; font-weight: 500;"
                    onmouseover="this.style.textDecoration='underline'"
                    onmouseout="this.style.textDecoration='none'">
                    Suppliers
                </a>
                <span>→</span>
                <span>Create Supplier</span>
            </div>
            <h2 style="font-size: 28px; font-weight: bold; color: #1f2937; margin: 0; display: flex; align-items: center; gap: 12px;">
                <span style="font-size: 32px;">🏢</span>
                Create Supplier
            </h2>
            <p style="color: #6b7280; margin: 8px 0 0 0; font-size: 16px;">Add a new supplier to your system</p>
        </div>

        <!-- Form Container -->
        <div style="background: white; border-radius: 16px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07); border: 1px solid #e5e7eb; overflow: hidden;">
            <!-- Form Header -->
            <div style="background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); padding: 24px; border-bottom: 1px solid #e5e7eb;">
                <h3 style="margin: 0; font-size: 18px; font-weight: 600; color: #1e40af; display: flex; align-items: center; gap: 8px;">
                    <span>📝</span> Supplier Information
                </h3>
                <p style="margin: 8px 0 0 0; color: #2563eb; font-size: 14px;">Fill in the details below to create a new supplier</p>
            </div>

            <!-- Form Content -->
            <div style="padding: 32px;">
                <form method="POST" action="{{ route('suppliers.store') }}" style="display: flex; flex-direction: column; gap: 24px;">
                    @csrf

                    <!-- Supplier Name Field -->
                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <label for="name" style="font-weight: 600; color: #374151; font-size: 14px; display: flex; align-items: center; gap: 8px;">
                            <span style="color: #3b82f6;">🏷️</span>
                            Supplier Name
                            <span style="color: #dc2626; font-size: 16px;">*</span>
                        </label>
                        <div style="position: relative;">
                            <input type="text"
                                id="name"
                                name="name"
                                required
                                placeholder="Enter supplier name..."
                                style="width: 100%; padding: 16px 20px; border: 2px solid #e5e7eb; border-radius: 12px; font-size: 16px; outline: none; transition: all 0.2s; background-color: #fafafa;"
                                onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 4px rgba(59, 130, 246, 0.1)'; this.style.backgroundColor='white'"
                                onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none'; this.style.backgroundColor='#fafafa'"
                                oninput="if(this.value.length > 0) { this.style.borderColor='#3b82f6'; } else { this.style.borderColor='#e5e7eb'; }">
                        </div>
                        <p style="font-size: 13px; color: #6b7280; margin: 0;">Enter a descriptive name for your supplier</p>
                    </div>

                    <!-- Action Buttons -->
                    <div style="display: flex; gap: 16px; margin-top: 24px; padding-top: 24px; border-top: 1px solid #f3f4f6;">
                        <button type="submit"
                            style="flex: 1; background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white; padding: 16px 24px; border: none; border-radius: 12px; font-weight: 600; font-size: 16px; cursor: pointer; transition: all 0.2s; display: flex; align-items: center; justify-content: center; gap: 8px; box-shadow: 0 2px 4px rgba(59, 130, 246, 0.2);"
                            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(59, 130, 246, 0.3)'"
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 4px rgba(59, 130, 246, 0.2)'">
                            <span style="font-size: 18px;">💾</span>
                            Save
                        </button>
                        <a href="{{ route('suppliers.index') }}"
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

        <!-- Help Section -->
        <div style="margin-top: 24px; background: linear-gradient(135deg, #fef7ff 0%, #faf5ff 100%); border-radius: 12px; padding: 20px; border: 1px solid #e9d5ff;">
            <h4 style="margin: 0 0 12px 0; font-size: 16px; font-weight: 600; color: #7c3aed; display: flex; align-items: center; gap: 8px;">
                <span>💡</span> Tips for Creating Suppliers
            </h4>
            <ul style="margin: 0; padding-left: 20px; color: #6b46c1; line-height: 1.6;">
                <li style="margin-bottom: 8px;">Use clear, descriptive names that are easy to identify</li>
                <li style="margin-bottom: 8px;">Supplier names should be unique to avoid confusion</li>
                <li style="margin-bottom: 8px;">Consider using company names or official business names</li>
                <li style="margin-bottom: 0;">You can always edit supplier details after creation</li>
            </ul>
        </div>

        <!-- Quick Stats -->
        <div style="margin-top: 24px; display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px;">
            <div style="background: white; border-radius: 12px; padding: 20px; border: 1px solid #e5e7eb; text-align: center;">
                <div style="font-size: 24px; font-weight: bold; color: #3b82f6; margin-bottom: 4px;">
                    New
                </div>
                <div style="font-size: 14px; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em;">
                    Supplier Status
                </div>
            </div>
        </div>
    </div>
</x-app-layout>