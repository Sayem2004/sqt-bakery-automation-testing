from selenium import webdriver
from selenium.webdriver.common.by import By
import time

driver = webdriver.Chrome()

try:
    print("Step 1: Delivery Login")

    driver.get("http://localhost/Bakery_Hub_new/common/View/login.php")
    driver.maximize_window()
    time.sleep(2)

    driver.find_element(By.ID, "email").send_keys("ff@gmail.com")
    driver.find_element(By.ID, "password").send_keys("123456")

    driver.find_element(By.XPATH, "//button[@type='submit']").click()
    time.sleep(3)

    print("Login Done")


    print("Step 2: Go to Delivery Dashboard")

    driver.get("http://localhost/Bakery_Hub_new/delivery/view/delivery_dashboard.php")
    time.sleep(3)

    print("Dashboard Opened")


    print("Step 3: Mark Order Delivered")

    driver.find_elements(By.XPATH, "//a[contains(text(),'Mark Delivered')]")[0].click()
    time.sleep(3)

    print("✅ Order Marked Delivered")


    print("Step 4: Logout")

    driver.find_element(By.LINK_TEXT, "Logout").click()
    time.sleep(2)

    print("✅ Logout Done")

except Exception as e:
    print("Error:", e)

finally:
    driver.quit()