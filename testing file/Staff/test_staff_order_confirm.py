from selenium import webdriver
from selenium.webdriver.common.by import By
import time

driver = webdriver.Chrome()

try:
    print("Step 1: Staff Login")

    driver.get("http://localhost/Bakery_Hub_new/common/View/login.php")
    driver.maximize_window()
    time.sleep(2)

    driver.find_element(By.ID, "email").send_keys("mdalimransayem2004@gmail.com")
    driver.find_element(By.ID, "password").send_keys("12345678")

    driver.find_element(By.XPATH, "//button[@type='submit']").click()
    time.sleep(3)

    print("Staff Login Done")


    print("Step 2: Go to Orders Page")

    driver.get("http://localhost/Bakery_Hub_new/staff/view/staff_orders.php")
    time.sleep(3)

    print("Orders Page Opened")


    print("Step 3: Confirm Order")

    driver.find_element(By.XPATH, "//a[contains(text(),'Accept')]").click()
    time.sleep(3)

    print("Order Confirmed")


    print("Step 4: Logout")

    driver.find_element(By.LINK_TEXT, "Logout").click()
    time.sleep(2)

    print("Logout Done")

except Exception as e:
    print("Error:", e)

finally:
    driver.quit()