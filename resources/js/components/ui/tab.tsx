import { useState, useEffect, ReactNode } from "react";
import { Link } from "@inertiajs/react";

interface Tab {
  value: string;
  label: string;
  link: string;
}

interface TabsProps {
  tabs: Tab[];
  defaultValue?: string;
  onChange?: (value: string) => void;
  children?: ReactNode;
}

export default function Tabs({ tabs, defaultValue, onChange, children }: TabsProps) {
  const [activeTab, setActiveTab] = useState(
    defaultValue || (tabs.length > 0 ? tabs[0].value : "")
  );

  useEffect(() => {
    if (!defaultValue && tabs.length > 0) {
      setActiveTab(tabs[0].value);
    }
  }, [defaultValue, tabs]);

  const selectTab = (value: string) => {
    setActiveTab(value);
    onChange?.(value);
  };

  // children must be keyed by tab.value
  const childMap: Record<string, ReactNode> = {};
  if (children) {
    // Expect children as <div data-tab="value">...</div>
    (Array.isArray(children) ? children : [children]).forEach((child: any) => {
      if (child?.props?.["data-tab"]) {
        childMap[child.props["data-tab"]] = child;
      }
    });
  }

  return (
    <div className="w-full">
      <div className="flex items-center justify-start text-gray-700 space-x-4 border-b border-gray-200">
        {tabs.map((tab) => (
          <Link
            key={tab.value}
            href={tab.link}
            className={[
              "inline-flex items-center justify-center whitespace-nowrap px-3 py-2 text-sm font-medium transition-all",
              "focus:outline-none",
              activeTab === tab.value
                ? "bg-white text-gray-900 border-b-2 border-black"
                : "hover:text-gray-900 hover:bg-gray-50",
            ].join(" ")}
            onClick={() => selectTab(tab.value)}
          >
            {tab.label}
          </Link>
        ))}
      </div>

      <div className="mt-4">
        {tabs.map((tab) =>
          activeTab === tab.value ? (
            <div key={tab.value}>{childMap[tab.value]}</div>
          ) : null
        )}
      </div>
    </div>
  );
}
